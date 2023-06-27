<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $accounts = $user->accounts()->get();
        $transactions = $user->transactions()->get();

        return view('dashboard', compact('accounts', 'transactions'));
    }
}
