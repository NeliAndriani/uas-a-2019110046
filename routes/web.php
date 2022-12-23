<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('menus', MenuController::class);

Route::get('/menus', [MenuController::class,'index'])->name('menus.index');
Route::get('/menus/create', [MenuController::class,'create'])->name('menus.create');
Route::post('/menus', [MenuController::class,'store'])->name('menus.store');
Route::get('/menus/{menu}', [MenuController::class,'show'])->name('menus.show');
Route::get('/menus/{menu}/edit', [MenuController::class,'edit'])->name('menus.edit');
Route::patch('/menus/{menu}', [MenuController::class,'update'])->name('menus.update');
Route::delete('/menus/{menu}', [MenuController::class,'destroy'])->name('menus.destroy');



Route::get('/', [AppController::class, 'index'])->name('appIndex');

Route::get('/order', [OrderController::class, 'order'])->name('orderView');
Route::get('/order/create', [OrderController::class, 'orderCreate'])->name('orderCreate');
Route::post('/order/store', [OrderController::class, 'orderStore'])->name('orderStore');


