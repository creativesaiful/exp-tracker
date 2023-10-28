<?php

namespace App\Http\Controllers;
use App\Models\expense;
use App\Models\Category;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function ExpenseView(){
        $cate = Category::where('user_id', auth()->user()->id)->get();
        return view('pages.expense', compact('cate'));
    }

    //Ajax for expense list
    public function ExpenseList(){
        $expense = expense::where('user_id', auth()->user()->id)->with('Category')->latest()->get();

        return response()->json($expense);
    }

    //Ajax for expense store

    public function ExpenseStore(Request $request){
        //Store the data in single line style
        
        try{
            $expense = new expense();
            $expense->user_id = auth()->user()->id;
            $expense->category_id = $request->category_id;
            $expense->expense_amount = $request->expense_amount;
            $expense->description = $request->description;
            $expense->payment_method = $request->payment_method;
            $expense->save();
    
            $message = [
                'type' => 'success',
                'message' => 'Expense added successfully'
            ];
    
            return response()->json($message);
        }catch(\Exception $e){
            $message = [
                'type' => 'error',
                'message' => $e->getMessage()
            ];
            return response()->json($message);
        }

    }


    public function ExpenseEdit($id){
        $expense = expense::where('id', $id)->with('Category')->get();
        return response()->json($expense);
    }


    public function ExpenseUpdate( Request $request, $id){
        try{
            $expense = expense::find($id);
        $expense->category_id = $request->category_id;
        $expense->expense_amount = $request->expense_amount;
        $expense->description = $request->description;
        $expense->payment_method = $request->payment_method;
        $expense->save();

        $message = [
            'type' => 'success',
            'message' => 'Expense updated successfully'
        ];
        return response()->json($message);
        } catch(\Exception $e){
            $message = [
                'type' => 'error',
                'message' => $e->getMessage()
            ];
            return response()->json($message);
        }
    }



    public function ExpenseDelete($id){
        $expense = expense::find($id);
        $expense->delete();

        $message = [
            'type' => 'success',
            'message' => 'Expense deleted successfully'
        ];
        return response()->json($message);
    }
}
