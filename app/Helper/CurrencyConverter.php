<?php

use Illuminate\Http\Request;

class CurrencyConverter
{   

    static function convert( $amount)
    {
        $exchangeRate = self::rate($request);
        return $amount * $exchangeRate;
    }

    static function rate(Request $request)
    {
        $rate = $request->session()->get('rate');
        return $rate;
    }
}


