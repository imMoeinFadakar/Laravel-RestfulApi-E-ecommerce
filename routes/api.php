<?php

use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\authController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\permissionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\brandController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\checkPermission;
use App\Models\admin\product;
use Database\Seeders\rolesSeeders;

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

    Route::get('brand/{brand}/products', [brandController::class, 'getProducts']);

    Route::get('category/{category}/products', [categoryController::class, 'getProducts']);


    Route::apiResource('category',categoryController::class);

    // Route::apiResource('products',ProductController::class);

    Route::apiResource('product',ProductController::class);

    Route::apiResource('product.gallery',GalleryController::class);

    Route::apiResource('role',RoleController::class);


