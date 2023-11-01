<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CurrencyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('/profile', [UserProfileController::class, 'ProfileView'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'ProfileUpdate'])->name('profile.update');


    Route::get('categories', [CategoryController::class, 'CategoryList'])->name('categories');
    Route::post('store-category', [CategoryController::class, 'CategoryStore'])->name('store-category');


    //ajax
    Route::get('edit-category/{id}',   [CategoryController::class, 'EditCategory'])->name('edit-category');
    Route::get('delete-category/{id}',   [CategoryController::class, 'DeleteCategory'])->name('delete-category');
   
   
    Route::post('update-category',   [CategoryController::class, 'UpdateCategory'])->name('update-category');

    Route::get('budgets', [BudgetController::class, 'BudgetList'])->name('budgets');

    Route::post('store-budget', [BudgetController::class, 'BudgetStore'])->name('budget-store');
    Route::get('delete-budget/{id}',   [BudgetController::class, 'DeleteBudget'])->name('delete-budget');

    Route::get('check-budget/{category_id}', [BudgetController::class, 'CheckBudget'])->name('check-budget');

    // Expense Routes
    Route::get('/expense', [ExpenseController::class,'ExpenseView'] )->name('expenseView');
    
   

    Route::post('store-expense', [ExpenseController::class,'ExpenseStore'] )->name('store-expense');
    
    //Ajax for expense
    Route::get('/expenses', [ExpenseController::class,'ExpenseList'] )->name('ExpenseList');
    Route::get('edit-expense/{id}', [ExpenseController::class,'ExpenseEdit'] );
   
    Route::get('expenses/{id}', [ExpenseController::class,'ExpenseDelete'] );
    Route::post('update-expense/{id}', [ExpenseController::class,'ExpenseUpdate'] );


    Route::get('currency-converter/{rate}', [CurrencyController::class, 'coverter'])->name('currency-converter');

    //Reports Route

    Route::get('expense-reports', function () {
        return view('pages.reports.expense-report');
    })->name('expense-reports');

    Route::get('budget-reports', function () {
        return view('pages.reports.budget-report');
    })->name('budget-reports');


});
