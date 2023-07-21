<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use PragmaRX\Google2FA\Google2FA;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->google2fa_secret) {
            return redirect()->route('two-factor.enable');
        }

        $accounts = Account::where('user_id', $user->id)->get();
        $transactions = Transaction::where(function ($query) use ($user) {
            $query->whereHas('senderAccount', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orWhereHas('recipientAccount', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })
            ->with(['senderAccount', 'recipientAccount'])
            ->withTrashed()
            ->get();

        return view('transactions', compact('user', 'accounts', 'transactions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'numeric',
        ]);

        $senderAccount = Account::findOrFail($request->input('sender_account'));
        $recipientAccount = Account::findOrFail($request->input('recipient_account'));
        $amount = $request->input('amount');
        $currencyConverter = new CurrencyService();
        $convertedAmount = $currencyConverter->convert($senderAccount->currency, $recipientAccount->currency, $amount);
        $currencyRate = $currencyConverter->getConversionRate($senderAccount->currency, $recipientAccount->currency) ?? 1;

        $validator->after(function ($validator) use ($senderAccount, $amount, $convertedAmount) {
            if ($senderAccount->balance < $amount) {
                $validator->errors()->add('amount', 'Insufficient balance for the transfer.');
            } elseif ($convertedAmount === null || $convertedAmount <= 0) {
                $validator->errors()->add('amount', 'Please enter a valid amount for the transfer.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userSecurityCode = $request->input('2fa_code');
        $is2FAVerified = $this->isDummy2FAValid($userSecurityCode);

        if (!$is2FAVerified) {
            return redirect()->back()->withErrors(['2fa_code' => 'Invalid 2FA code.']);
        }

        $transactionData = [
            'amount' => $amount,
            'converted_amount' => $convertedAmount,
            'currency_rate' => $currencyRate,
            'amount_received' => $convertedAmount,
            'sender_account_id' => $senderAccount->id,
            'recipient_account_id' => $recipientAccount->id,
            'user_id' => Auth::id(),
            'security_code' => $userSecurityCode,
        ];

        $request->session()->put('transaction', $transactionData);

        Transaction::create($transactionData);

        return redirect()->route('dashboard')->with('success', 'Transaction confirmed.');
    }

    public function isDummy2FAValid($securityCode)
    {
        return $securityCode === '123';
    }
    public function showConfirmationView()
    {
        $transactionData = session('transaction');

        if (!is_array($transactionData) || !array_key_exists('security_code', $transactionData)) {
            return redirect()->back()->withErrors(['error' => 'Transaction data not available or incomplete.']);
        }

        return view('transaction_confirmation', compact('transactionData'));
    }

    public function confirmTransaction(Request $request)
    {
        $userSecurityCode = $request->input('2fa_code');
        $is2FAVerified = $this->isDummy2FAValid($userSecurityCode);

        if (!$is2FAVerified) {
            return false;
        }

        return true;
    }

    public function verify2FACode($securityCode)
    {
        $user = auth()->user();

        if (!$user->google2fa_secret) {
            return false;
        }

        $google2fa = new Google2FA();
        $is2FAVerified = $google2fa->verifyKey($user->google2fa_secret, $securityCode);

        return $is2FAVerified;
    }
}
