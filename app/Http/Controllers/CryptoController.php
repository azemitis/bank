<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function index()
    {
        return view('crypto.index');
    }
}
