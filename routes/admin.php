<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;

Route::get('/', function(){

    return view('admin.dashboard');

})->name('dashboard');

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);
