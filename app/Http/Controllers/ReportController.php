<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ReportController extends Controller
{
    public function ReportExpenseView(){
        
    }

    public function ReportExpense(Request $request){

    

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $category_id = $request->input('category_id');
        $payment_method = $request->input('payment_method');
    
        // Validate the input dates if needed

        
    
        $expenses = Expense::where('user_id', auth()->user()->id)
            ->whereBetween('created_at', [$start_date, $end_date]);
    
        if (!empty($category_id)) {
            $expenses->where('category_id', $category_id);
        }
    
        if (!empty($payment_method)) {
            $expenses->where('payment_method', $payment_method);
        }
    
        $result = $expenses->get();

    
        // You can return the result or perform other actions as needed

        $expenses = Expense::get();
        return $result;
    }
    

}

