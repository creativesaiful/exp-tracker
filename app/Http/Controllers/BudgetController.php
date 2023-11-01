<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Support\Facades\Schema;

class BudgetController extends Controller
{
    public function BudgetList(){
        $budgets = Budget::where('user_id', auth()->user()->id)->with('Category') ->get();

        $cate = Category::where('user_id', auth()->user()->id)->get();

        //Neet to retrived enum names from budget table and store it in perion variable
        $periods = ['monthly', 'yearly'];


       $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

       $years = ['2023','2024','2025','2026', '2027', '2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035', '2036', '2037', '2038', '2039', '2040'];

   

  
        return view('pages.budget_list', compact('budgets', 'cate', 'periods', 'months', 'years'));
    }


    public function BudgetStore(Request $request){

   
        $validated = $request->validate([
            'category_id' => 'required',
            'period' => 'required',
            'year' => 'required',
            'budget_amount' => 'required',
        ]);

        $user_id = auth()->user()->id;
        $category_id = $request->category_id;
        $period = $request->period;
        $month_name = $request->month_name;
        $year = $request->year;
        $budget_amount = $request->budget_amount;

        if(!empty($month_name)){

            $isexits = Budget::where('user_id', $user_id)->where('category_id', $category_id)->where('period', $period)->where('month_name', $month_name)->where('year', $year)->exists();      

        }else{
            $isexits = Budget::where('user_id', $user_id)->where('category_id', $category_id)->where('period', $period)->where('year', $year)->exists();
        }

        if($isexits){
            $message = [
                'type' => 'error',
                'message' => 'Budget already exists'
            ];
            return response()->json($message);
        }else{
            $budget = new Budget();
            $budget->user_id = $user_id;
            $budget->category_id = $category_id;
            $budget->period = $period;

            if( $period == 'monthly'){
                $budget->month_name = $month_name;
            }
            
            $budget->year = $year;
            $budget->budget_amount = $budget_amount;

            $budget->save();

            $message = [
                'type' => 'success',
                'message' => 'Budget created successfully'
            ];

            return response()->json($message);



        }

    }

    //Delete Budget
        //ajax for delete
        public function DeleteBudget($id){
        
            try {
                 $budget = Budget::find($id);
                 $budget->delete();
     
                 return response ()->json([
                     'type' => 'success',
                     'message'=>'Budget was deleted successfully',
                 ]);
     
             } catch (\Throwable $th) {
                 return response ()->json([
                     'type' => 'error',
                     'message'=>'Something went wrong',
                 ]);
             }
         }




         //ajax for budget check
         public function CheckBudget($category_id){
            //get budget for this month and year
            $monthly_budget = Budget::where('user_id', auth()->user()->id)
            ->where('category_id', $category_id)
            ->where('period', 'monthly')
            ->where('month_name', date('F'))
            ->where('year', date('Y'))
            ->select('budget_amount')
            ->first();
        
        $yearly= Budget::where('user_id', auth()->user()->id)
            ->where('category_id', $category_id)
            ->where('period', 'yearly')
            ->where('year', date('Y'))
            ->first();

        

        if($yearly != null){
            $yearly_budget = $yearly->budget_amount;
        }else{
            $yearly_budget = Budget::where('user_id', auth()->user()->id)
            ->where('category_id', $category_id)
            ->where('period', 'monthly')
            ->where('year', date('Y'))
            ->sum('budget_amount');

            if($yearly_budget == null){
                $yearly_budget = 0;
            }
        }
        


        
        // Extract the budget_amount value from the $monthly_budget object
        $monthly_budget_amount = $monthly_budget ? $monthly_budget->budget_amount : 0;
        
        //get expense total for this month and year in this category
        $total_expense_month = Expense::where('user_id', auth()->user()->id)
            ->where('category_id', $category_id)
            ->whereBetween('created_at', [now()->startOfMonth(), now()])
            ->sum('expense_amount');
        
        $remaining_monthly_budget = $monthly_budget_amount - $total_expense_month;
        $remaining_yearly_budget = $yearly_budget - $total_expense_month;

            return response ()->json([
                'remaining_monthly_budget' => $remaining_monthly_budget,
                'remaining_yearly_budget' => $remaining_yearly_budget,
                
               
            ]);



         }
}
