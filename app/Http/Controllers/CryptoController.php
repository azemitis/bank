<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

            foreach ($cryptocurrencies as &$cryptocurrency) {
                $logoUrl = $this->getLogoUrl($cryptocurrency['symbol']);
                $cryptocurrency['logo_url'] = $logoUrl;
            }

            return view('crypto.index', compact('cryptocurrencies'));
        } catch (\Exception $e) {
            return back()->withErrors('Failed to fetch cryptocurrency data.');
        }
    }

    private function getLogoUrl($symbol)
    {
        $baseUrl = 'https://s2.coinmarketcap.com/static/img/coins/64x64';
        return $baseUrl . '/' . $symbol . '.png';
    }
}
