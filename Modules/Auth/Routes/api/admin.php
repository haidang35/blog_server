<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1/admin/auth')->controller(AuthController::class)->name('v1.admin.auth.')->group(function() {
    Route::post('/login', 'login')->name('login');
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/myAccount', 'getMyAccount')->name('getMyAccount');
    });
});
