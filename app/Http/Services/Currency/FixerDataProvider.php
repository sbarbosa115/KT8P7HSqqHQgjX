<?php

declare(strict_types=1);

namespace App\Http\Services\Currency;

use ErrorException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class FixerDataProvider
{

    private string $fixerApiKey;

    public function __construct(string $fixerApiKey)
    {
        $this->fixerApiKey = $fixerApiKey;
    }

    /**
     * @throws ErrorException
     */
    public function getCurrencies(): array
    {
        $response = Http::get(sprintf('http://data.fixer.io/api/symbols?access_key=%s', $this->fixerApiKey));
        $data = json_decode($response->body(), true);

        if (empty($data) || $response->status() !== Response::HTTP_OK) {
            throw new ErrorException('Empty response received from Fixer.io');
        }

        return array_slice($data['symbols'], 0, 4);
    }

    public function convertCurrencies(string $from, string $to, float $amount): float
    {
//        $response = Http::get(sprintf('http://data.fixer.io/api/convert?access_key=%s&from=%s&to=%s&amount%s', $this->fixerApiKey, $from, $to, $amount));
        $response = Http::get(sprintf('http://data.fixer.io/api/latest?access_key=%s&base=%s&symbols=%s', $this->fixerApiKey, $from, $to));
        $data = json_decode($response->body(), true);

        if (empty($data) || $response->status() !== Response::HTTP_OK || !$data['success']) {
            throw new ErrorException('Empty response received from Fixer.io');
        }

        return $data['rates'][$to] * $amount;
    }
}
