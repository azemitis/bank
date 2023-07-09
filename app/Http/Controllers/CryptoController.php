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
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';

        try {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $apiKey,
            ])->get($url);

            $data = $response->json();
            $cryptocurrencies = $data['data'];
            $ownedCryptocurrencies = CryptoCurrency::all();

            return view('crypto.index', compact('cryptocurrencies', 'ownedCryptocurrencies'));
        } catch (\Exception $e) {
            return back()->withErrors('Failed to fetch cryptocurrency data.');
        }
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

        return view('crypto.create', compact(
            'accounts',
            'selectedCryptocurrency',
            'cryptocurrencies',
            'selectedCurrencyName',
            'selectedCurrencyRate'
        ));
    }

    public function store(Request $request)
    {
        Cryptocurrency::create([
            'name' => $request->input('cryptocurrency_name'),
            'price_bought' => $request->input('cost'),
            'amount' => $request->input('amount'),
            'account_id' => $request->input('account_id'),
        ]);

        return redirect()->route('crypto.index')->with('success', 'Cryptocurrency bought successfully.');
    }
}
