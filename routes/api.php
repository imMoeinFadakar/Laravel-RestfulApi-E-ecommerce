<?php

use App\Http\Controllers\admin\categoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\brandController;
use App\Http\Controllers\ProductController;
use App\Models\admin\product;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('brand', brandController::class);

Route::apiResource('category',categoryController::class);

// Route::apiResource('products',ProductController::class);

Route::apiResource('product',ProductController::class);




