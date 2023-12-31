<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Cryptocurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CryptoController extends Controller
{
    public function index()
    {
        $apiKey = env('CMC_API_KEY');

        // Check if the crypto API key is added
        if (!$apiKey) {
            $cryptocurrencies = [];
            $ownedCryptocurrencies = [];
        } else {
            $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';

            try {
                $response = Http::withHeaders([
                    'X-CMC_PRO_API_KEY' => $apiKey,
                ])->get($url);

                $data = $response->json();
                $cryptocurrencies = $data['data'];
                $ownedCryptocurrencies = CryptoCurrency::whereHas('account', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })->get();
            } catch (\Exception $e) {
                // If there is an exception, return an empty array for cryptocurrencies
                $cryptocurrencies = [];
                $ownedCryptocurrencies = [];
            }
        }

        if (empty($ownedCryptocurrencies)) {
            $ownedCryptocurrencies = [];
        }

        return view('crypto.index', compact('cryptocurrencies', 'ownedCryptocurrencies'));
    }

    public function create(Request $request)
    {
        $accounts = Account::where('user_id', auth()->user()->id)->get();
        $selectedCryptocurrencyId = $request->input('cryptocurrency_id');
        $selectedCryptocurrency = CryptoCurrency::find($selectedCryptocurrencyId);
        $cryptocurrencies = CryptoCurrency::all();

        $selectedCurrencyName = $request
            ->input('selected_currency_name') ?? ($selectedCryptocurrency ? $selectedCryptocurrency
            ->name : '');
        $selectedCurrencyRate = $request
            ->input('selected_currency_rate') ?? ($selectedCryptocurrency ? $selectedCryptocurrency
            ->quote['USD']['price'] : '');

        $errorMessages = $request->session()
            ->get('errors') ? $request->session()
            ->get('errors')
            ->getBag('default')
            ->getMessages() : [];

        return view('crypto.create', compact(
            'accounts',
            'selectedCryptocurrency',
            'cryptocurrencies',
            'selectedCurrencyName',
            'selectedCurrencyRate',
            'errorMessages'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|gt:0',
            'cost' => 'required|numeric|gt:0',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validate the 2FA code
        $verificationController = new VerificationController();
        if (!$verificationController->verify2FACode($request)) {
            return redirect()->back()->withErrors(['2fa_code' => 'Please enter your 2FA code to continue.'])->withInput();
        }

        $account = Account::findOrFail($request->input('account_id'));
        $cost = $request->input('cost');

        if ($account->balance < $cost) {
            return redirect()->back()->withErrors('Insufficient funds.');
        }

        $account->balance -= $cost;
        $account->save();

        Cryptocurrency::create([
            'name' => $request->input('cryptocurrency_name'),
            'price_bought' => $cost,
            'amount' => $request->input('amount'),
            'account_id' => $request->input('account_id'),
        ]);

        return redirect()->route('crypto.index')->with('success', 'Cryptocurrency bought successfully.');
    }

    public function destroy(Cryptocurrency $cryptocurrency)
    {
        $account = $cryptocurrency->account;
        $priceBought = $cryptocurrency->price_bought;

        $account->balance += $priceBought;
        $account->save();

        $cryptocurrency->delete();

        return redirect()->route('crypto.index')->with('success', 'Cryptocurrency sold successfully.');
    }
}
