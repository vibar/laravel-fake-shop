<?php

namespace App\Http\Controllers\API;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    /**
     * @var CurrencyService
     */
    private $currencyService;

    /**
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $user = $request->user();

        DB::transaction(function () use ($user, $currency) {

            $this->currencyService->sync($currency);

            $user->currency_id = $currency->id;
            $user->save();

        });

        return response()->json(['data' => $currency]);
    }

}
