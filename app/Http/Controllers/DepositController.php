<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\DepositAccount;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        $depositAccounts = DepositAccount::where('user_id', Auth::id())->get();
        $terms = [3, 6, 12, 24];
        return view('deposits.index', compact('accounts', 'depositAccounts', 'terms'));
    }

    public function create()
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        $terms = [3, 6, 12, 24];
        $rates = [
            3 => 5,
            6 => 6,
            12 => 7,
            24 => 8
        ];
        return view('deposits.create', compact('accounts', 'terms', 'rates'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_account' => 'required|exists:accounts,id',
            'currency' => 'required|in:EUR,USD,GBP',
            'term' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        $fromAccount = Account::findOrFail($request->input('from_account'));
        $currency = $request->input('currency');
        $term = $request->input('term');
        $amount = $request->input('amount');
        $accountNumber = $fromAccount->account_number;

        if (is_numeric($amount)) {
            $validator->after(function ($validator) use ($fromAccount, $amount) {
                if ($fromAccount->balance < $amount) {
                    $validator->errors()->add('from_account', 'The selected account has insufficient balance.');
                }
            });
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rates = [
            3 => 5,
            6 => 6,
            12 => 7,
            24 => 8
        ];
        $rate = $rates[$term];
        if ($currency !== $fromAccount->currency) {
            $conversionRate = $this->currencyService->getConversionRate($currency, $fromAccount->currency);

            if ($conversionRate !== null) {
                $amount = $this->currencyService->convert($fromAccount->currency, $currency, $amount);
                $finalAmount = $amount * (1 + ($rate / 100));
            } else {
                return redirect()->back()->withErrors(['currency' => 'Currency conversion is not available.'])->withInput();
            }
        } else {
            $finalAmount = $amount * (1 + ($rate / 100));
        }

        $depositAccount = new DepositAccount();
        $depositAccount->user_id = Auth::id();
        $depositAccount->from_account = $request->input('from_account');
        $depositAccount->account_number = $accountNumber;
        $depositAccount->currency = $currency;
        $depositAccount->term = $term;
        $depositAccount->rate = $rate;
        $depositAccount->amount = $amount;
        $depositAccount->amount_with_interests = $finalAmount;
        $depositAccount->save();

        $fromAccount->balance -= $amount;
        $fromAccount->save();

        return redirect()->route('deposits.index')->with('success', 'Deposit account opened successfully.');
    }

    public function withdraw(DepositAccount $depositAccount)
    {
        $fromAccount = Account::findOrFail($depositAccount->from_account);

        $fromAccount->balance += $depositAccount->amount;
        $fromAccount->save();

        $depositAccount->delete();

        return redirect()->route('deposits.index')->with('success', 'Deposit withdrawn successfully.');
    }
}
