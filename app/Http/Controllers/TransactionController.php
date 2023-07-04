<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $senderAccount = Account::findOrFail($request->input('sender_account'));
        $recipientAccount = Account::findOrFail($request->input('recipient_account'));
        $amount = $request->input('amount');

        if ($senderAccount->balance < $amount) {
            return redirect()->back()->with('error', 'Insufficient balance for the transfer.');
        }

        $currencyConverter = new CurrencyConverter();
        $convertedAmount = $currencyConverter->convert($senderAccount->currency, $recipientAccount->currency, $amount);

        if ($convertedAmount === null) {
            return redirect()->back()->with('error', 'Unable to perform currency conversion.');
        }

        if ($senderAccount->balance < $convertedAmount) {
            return redirect()->back()->with('error', 'Insufficient balance for the transfer after currency conversion.');
        }

        $senderAccount->balance -= $amount;
        $recipientAccount->balance += $convertedAmount;

        $senderAccount->save();
        $recipientAccount->save();

        $transaction = new Transaction([
            'amount' => $amount,
            'converted_amount' => $convertedAmount,
            'sender_account_id' => $senderAccount->id,
            'recipient_account_id' => $recipientAccount->id,
            'user_id' => Auth::id(),
        ]);
        $transaction->save();

        return redirect()->route('dashboard')->with('success', 'Transfer successful.');
    }
}
