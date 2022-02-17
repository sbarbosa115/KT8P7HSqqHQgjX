<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyExchange;
use App\Http\Services\Currency\FixerDataProvider;
use ErrorException;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{

    /**
     * Return all currencies available.
     * @throws ErrorException
     */
    public function index(FixerDataProvider $dataProvider): JsonResponse
    {
        $currencies = [];

        foreach ($dataProvider->getCurrencies() as $currencySymbol => $currency) {
            $currencies[] = [
                'name' => $currency,
                'symbol' => $currencySymbol
            ];
        }

        return response()->json($currencies);
    }

    /**
     * @throws ErrorException
     */
    public function exchange(FixerDataProvider $dataProvider, CurrencyExchange $request): JsonResponse
    {
        $data = $request->all();

        return response()->json([
            ...$data,
            'amount_exchanged' => $dataProvider->convertCurrencies($data['from'], $data['to'], $data['amount'])
        ]);
    }
}
