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
        return response()->json(
            $dataProvider->getCurrencies()
        );
    }

    /**
     * @throws ErrorException
     */
    public function exchange(FixerDataProvider $dataProvider, CurrencyExchange $request): JsonResponse
    {
        $data = $request->all();

        return response()->json($dataProvider->exchange($data['from'], $data['to'], $data['amount']));
    }
}
