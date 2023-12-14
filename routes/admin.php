<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FamilyController;

Route::get('/', function(){

    return view('admin.dashboard');

})->name('dashboard');

Route::resource('families', FamilyController::class);
