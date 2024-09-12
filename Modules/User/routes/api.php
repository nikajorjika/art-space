<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\LoginController;
use Modules\User\Http\Controllers\MeController;
use Modules\User\Http\Controllers\RegistrationController;
use Modules\User\Http\Controllers\UserController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum', 'api'])->prefix('v1')->group(function () {
    Route::get('/user/me', MeController::class)->name('user.me');
    Route::apiResource('user', UserController::class)->names('user');
});

Route::middleware(['api'])->prefix('v1')->group(function () {
    Route::post('/user/register', RegistrationController::class)->name('user.register');
    Route::post('/user/login', LoginController::class)->name('user.login');
});
