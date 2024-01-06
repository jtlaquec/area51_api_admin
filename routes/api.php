<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\PaymentMethodController;
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

Route::get('/store/subcategoryOld/{subcategory}', [StoreController::class, 'productosPorSubcategoria2']);

Route::get('/store/productColors/{idProduct}', [StoreController::class, 'listarColoresPorProducto']);

Route::get('/locations', [LocationController::class, 'listarTodo']);

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
// Rutas de Productos y Variantes
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/variants/{variant}', [ProductVariantController::class, 'show'])->name('variants.show');

Route::post('/login', [CustomerController::class, 'login']);

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{order}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('/{order}', [OrderController::class, 'update']);
    Route::delete('/{order}', [OrderController::class, 'destroy']);
});


Route::get('/orders/customer/{userId}', [OrderController::class, 'listarOrdenesPorCliente']);

Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::get('/{comment}', [CommentController::class, 'show']);
    Route::post('/', [CommentController::class, 'store']);
    Route::put('/{comment}', [CommentController::class, 'update']);
    Route::delete('/{comment}', [CommentController::class, 'destroy']);
});

Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);
    Route::get('/{payment}', [PaymentController::class, 'show']);
    Route::post('/', [PaymentController::class, 'store']);
    Route::put('/{payment}', [PaymentController::class, 'update']);
    Route::delete('/{payment}', [PaymentController::class, 'destroy']);
});

Route::get('/payment_methods', [PaymentMethodController::class, 'listarMetodosPago']);

Route::get('/shipping_methods', [ShippingController::class, 'listarMetodosEnvio']);

Route::post('/shippings', [ShippingController::class, 'crearEnvio']);
Route::put('/shippings/{id}', [ShippingController::class, 'editarEnvio']);

Route::get('/shippings/{id}', [ShippingController::class, 'verEnvio']);
