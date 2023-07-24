<?php

use Illuminate\Support\Facades\Route;

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

//43
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\VisitorController::class, 'index'])->name('Vpage');


Route::get('/category', [App\Http\Controllers\CategoryController::class, 'show'])->name('cat.show');

Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('cat.store');

Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('cat.delete');

Route::post('/category/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('cat.update');


//meals

Route::get('/meal/show', [App\Http\Controllers\MealController::class, 'index'])->name('meal.index');
Route::post('/meal/store', [App\Http\Controllers\MealController::class, 'store'])->name('meal.store');
Route::get('/meal/create', [App\Http\Controllers\MealController::class, 'create'])->name('meal.create');
Route::get('/meal/edit/{id}', [App\Http\Controllers\MealController::class, 'edit'])->name('meal.edit');
Route::post('/meal/update/{id}', [App\Http\Controllers\MealController::class, 'update'])->name('meal.update');
Route::get('/meal/delete/{id}', [App\Http\Controllers\MealController::class, 'delete'])->name('meal.delete');
Route::get('/meal/show/{id}', [App\Http\Controllers\MealController::class, 'show_details'])->name('meal_details');


//orders
Route::post('/order/store', [App\Http\Controllers\HomeController::class, 'order_store'])->name('order.store');
Route::post('/order/{id}/status', [App\Http\Controllers\HomeController::class, 'order_status'])->name('order.status');
Route::get('/order/show', [App\Http\Controllers\HomeController::class, 'show_order'])->name('order.show');