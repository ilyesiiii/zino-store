<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;


Route::get('/', function () {
    return redirect()->route('login.index');
});

// Login routes
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class,'authenticate'])->name('login.authenticate');

Route::get('/login/create', [LoginController::class, 'create'])->name('login.create');
Route::post('/login/create', [LoginController::class, 'store'])->name('login.store');
Route::post('/login/show/{id}',[LoginController::class, 'show'])->name('login.show');


Route::post('/logout',[LoginController::class, 'destroy'])->name('logout');
// Resource routes
Route::resource('orders', OrderController::class);
Route::resource('produits', ProductController::class);


