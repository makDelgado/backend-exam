<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'showProducts']);
    Route::post('/add', [ProductController::class, 'addProduct']);
    Route::put('/edit/{id}', [ProductController::class, 'updateProduct']);
    Route::get('/delete/{id}', [ProductController::class, 'deleteProduct']);
});
