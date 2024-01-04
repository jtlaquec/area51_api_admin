<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ProductVariantController;

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

Route::get('/store', [StoreController::class, 'index']);
Route::get('/store/subcategory/{subcategory}', [StoreController::class, 'productosPorSubcategoria']);
Route::get('/store/search', [StoreController::class, 'search']);
Route::get('/store/colors', [StoreController::class, 'listarColores']);
Route::get('/store/sizes', [StoreController::class, 'listarTallas']);

Route::get('/departments', [LocationController::class, 'listarDepartamentos']);
Route::get('/provinces', [LocationController::class, 'listarProvincias']);
Route::get('/districts', [LocationController::class, 'listarDistritos']);
Route::get('/departments/{department}/provinces', [LocationController::class, 'listarProvinciasPorDepartamento']);
Route::get('/provinces/{province}/districts', [LocationController::class, 'listarDistritosPorProvincia']);

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/{user}', [CustomerController::class, 'show']);
    Route::post('/', [CustomerController::class, 'store']);
    Route::put('/{user}', [CustomerController::class, 'update']);
    Route::delete('/{user}', [CustomerController::class, 'destroy']);
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/variants/{variant}', [ProductVariantController::class, 'show'])->name('variants.show');

Route::post('/login', [CustomerController::class, 'login']);
