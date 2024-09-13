<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageController::class)->name('home');
Route::get('/category/{category}', CategoryController::class)->name('category');
