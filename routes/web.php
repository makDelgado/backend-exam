<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();

Route::get('/admin/product', [HomeController::class, 'index'])->name('admin');
Route::get('/admin/product', [ProductController::class, 'index'])->middleware('auth');
Route::get('/admin/product/add', [ProductController::class, 'addProduct'])->middleware('auth');
Route::get('/admin/product/edit', [ProductController::class, 'editProduct'])->middleware('auth');
