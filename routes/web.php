<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomePageController::class)->name('home');
