<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Admin\UserController;

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

Route::prefix('users')->middleware(['auth:sanctum'])->controller(UserController::class)
    ->group(function() {
       Route::get('/', 'getList')->name('getList')->middleware(['can:users.view']);
       Route::get('/{id}', 'getDetails')->name('getDetails');
       Route::post('/', 'create')->name('create');
       Route::put('/{id}', 'update')->name('update');
       Route::delete('/{id}', 'update')->name('delete');
    });
