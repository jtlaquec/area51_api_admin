<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SubcategoryController;

Route::get('/', function(){

    return view('admin.dashboard');

})->name('dashboard');

Route::get('/options', [OptionController::class, 'index'])->name('options.index');

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('comments', CommentController::class);

Route::post('/users/generatePassword/{user}', [UserController::class, 'generatePassword'])->name('users.generatePassword');

Route::resource('orders', OrderController::class);

Route::resource('departments', DepartmentController::class);

Route::get('/features', [FeatureController::class, 'index'])->name('features.index');

Route::resource('variants', VariantController::class);

Route::delete('/variants/{id}', [UserController::class, 'delete'])->name('variants.delete');

/* Route::middleware(['role:Administrador'])->group(function () {

}); */

Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');


Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

