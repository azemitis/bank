<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0'
        ]);

        $senderAccount = Account::findOrFail($request->input('sender_account'));
        $recipientAccount = Account::findOrFail($request->input('recipient_account'));
        $amount = $request->input('amount');

        if ($senderAccount->balance < $amount) {
            return redirect()->back()->with('error', 'Insufficient balance for the transfer.');
        }

        $senderAccount->balance -= $amount;
        $recipientAccount->balance += $amount;

        $senderAccount->save();
        $recipientAccount->save();

        $transaction = new Transaction([
            'amount' => $amount,
            'sender_account_id' => $senderAccount->id,
            'recipient_account_id' => $recipientAccount->id,
            'user_id' => Auth::id(),
        ]);
        $transaction->save();

        return redirect()->route('dashboard')->with('success', 'Transfer successful.');
    }
}
