<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fixedString = 'LV33TREL';
        $randomDigits = mt_rand(1000000000, 9999999999);

        $account = new Account([
            'account_number' => $fixedString . $randomDigits,
            'balance' => $request->input('amount', 0),
            'currency' => $request->input('currency', 'EUR')
        ]);

        $user->accounts()->save($account);

        return redirect()->route('dashboard')->with('success', 'New account opened successfully.');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('dashboard')->with('success', 'Account closed successfully.');
    }
}
