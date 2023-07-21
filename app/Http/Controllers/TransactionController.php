<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user instanceof User || !$user->google2fa_secret) {
            return false;
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
            '2fa_code' => 'required',
        ]);

        $senderAccountId = (int) $request->input('sender_account');
        $recipientAccountId = (int) $request->input('recipient_account');

        $validator->after(function ($validator) use ($senderAccountId, $recipientAccountId) {
            if ($senderAccountId === $recipientAccountId) {
                $validator->errors()->add('sender_account', 'Sender and recipient accounts cannot be the same.');
            }
        });

        $senderAccount = Account::findOrFail($senderAccountId);
        $recipientAccount = Account::findOrFail($recipientAccountId);
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
        $is2FAVerified = $this->verify2FACode($userSecurityCode);

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


    public function verify2FACode($securityCode)
    {
        $user = auth()->user();

        if (!$user instanceof User || !$user->google2fa_secret) {
            return false;
        }

        $google2fa = new Google2FA();
        $is2FAVerified = $google2fa->verifyKey($user->google2fa_secret, $securityCode);

        return $is2FAVerified;
    }
}
