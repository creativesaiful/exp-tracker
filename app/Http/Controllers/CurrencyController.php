<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{

   
    public function coverter(Request $request, $rate) {
        $request->session()->put('rate', $rate);

        $code = $request->input('code');

        $request->session()->put('code', $code);


      

        return response()->json([
            'rate' => $rate,
            'code' => $code
        ]);
    }


}

