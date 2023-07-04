<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CurrencyConverter extends Controller
{
    private $conversionRates;

    public function __construct()
    {
        $this->fetchConversionRates();
    }

    public function convert(string $originalCurrency, string $recipientCurrency, float $amount): ?float
    {
        if (isset($this->conversionRates[$originalCurrency])
            && isset($this->conversionRates[$originalCurrency][$recipientCurrency])) {
            $conversionRate = $this->conversionRates[$originalCurrency][$recipientCurrency];
            return $amount * $conversionRate;
        }

        return null;
    }

    private function fetchConversionRates(): void
    {
        $response = Http::get('https://www.bank.lv/vk/ecb.xml');

        if ($response->successful()) {
            $xmlString = $response->body();
            $xml = simplexml_load_string($xmlString);

            $currencies = $xml->Currencies->Currency;

            foreach ($currencies as $currency) {
                $currencyCode = (string) $currency->ID;
                $rate = (float) $currency->Rate;

                if ($currencyCode !== 'EUR') {
                    $this->conversionRates['EUR'][$currencyCode] = $rate;
                    $this->conversionRates[$currencyCode]['EUR'] = 1 / $rate;
                }
            }

            $this->calculateConversionRates('USD', 'GBP');
            $this->calculateConversionRates('GBP', 'USD');
        }
    }

    private function calculateConversionRates(string $currency1, string $currency2): void
    {
        $this->conversionRates[$currency1][$currency2] =
            $this->conversionRates['EUR'][$currency2] / $this->conversionRates['EUR'][$currency1];
        $this->conversionRates[$currency2][$currency1] =
            1 / $this->conversionRates[$currency1][$currency2];
    }
}
