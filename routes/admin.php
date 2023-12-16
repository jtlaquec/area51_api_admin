<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function(){

    return view('admin.dashboard');

})->name('dashboard');

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
