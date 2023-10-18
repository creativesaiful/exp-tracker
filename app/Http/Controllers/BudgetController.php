<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function BudgetList(){
        return view('pages.budget_list');
    }
}
