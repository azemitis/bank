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

            return view('crypto.index', compact('cryptocurrencies'));
        } catch (\Exception $e) {
            return back()->withErrors('Failed to fetch cryptocurrency data.');
        }
    }

    public function create()
    {
        $accounts = Account::where('user_id', auth()->user()->id)->get();
        $selectedCryptocurrencyId = request()->input('cryptocurrency_id');
        $selectedCryptocurrency = Cryptocurrency::find($selectedCryptocurrencyId);
        $cryptocurrencies = Cryptocurrency::all();

        return view('crypto.create',
            compact('accounts', 'selectedCryptocurrency', 'cryptocurrencies'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'cryptocurrency_id' => 'required|exists:cryptocurrencies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $account = Account::findOrFail($request->input('account_id'));
        $amount = $request->input('amount');
        $cost = $request->input('cost');
        $rate = $request->input('rate');
        $cryptocurrencyId = $request->input('cryptocurrency_id');

        if ($account->balance < $cost) {
            return redirect()->back()->withErrors('Insufficient funds.');
        }

        $account->balance -= $cost;
        $account->save();

        $crypto = new Cryptocurrency([
            'name' => 'Cryptocurrency',
            'symbol' => 'CRYPTO',
            'price_bought' => $rate,
            'amount' => $amount,
            'account_id' => $account->id,
        ]);

        $user->cryptocurrencies()->save($crypto);

        return redirect()->route('crypto.index')->with('success', 'Cryptocurrency bought successfully.');
    }
}
