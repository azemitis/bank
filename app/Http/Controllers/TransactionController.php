<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['senderAccount', 'recipientAccount'])
            ->withTrashed()
            ->get();

        return view('transactions', compact('transactions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'numeric',
        ]);

        $senderAccount = Account::findOrFail($request->input('sender_account'));
        $recipientAccount = Account::findOrFail($request->input('recipient_account'));
        $amount = $request->input('amount');
        $currencyConverter = new CurrencyConverter();
        $convertedAmount = $currencyConverter->convert($senderAccount->currency, $recipientAccount->currency, $amount);
        $currencyRate = $currencyConverter->getConversionRate($senderAccount->currency, $recipientAccount->currency);

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

        $senderAccount->balance -= $amount;
        $recipientAccount->balance += $convertedAmount;

        $senderAccount->save();
        $recipientAccount->save();

        $transaction = new Transaction([
            'amount' => $amount,
            'converted_amount' => $convertedAmount,
            'currency_rate' => $currencyRate,
            'amount_received' => $convertedAmount,
            'sender_account_id' => $senderAccount->id,
            'recipient_account_id' => $recipientAccount->id,
            'user_id' => Auth::id(),
        ]);
        $transaction->save();

        return redirect()->route('dashboard')->with('success', 'Money transfer successful.');
    }
}
