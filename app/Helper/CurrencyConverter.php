<?php

use Illuminate\Http\Request;



class CurrencyConverter
{   


   
  
    static function convert( $amount)
    {
        $exchangeRate = self::rate();
        return $amount * $exchangeRate;
    }

    static function rate()
    {
        $rate = session('rate');
        return $rate;
    }
}


