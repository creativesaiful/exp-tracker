<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;

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

});
