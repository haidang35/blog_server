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

Route::prefix('users')->middleware(['auth:sanctum', 'can:users.*'])
    ->controller(UserController::class)
    ->group(function() {
       Route::get('/', 'getList')->name('getList')->middleware(['can:users.view']);
       Route::get('/{id}', 'getDetails')->name('getDetails')->middleware(['can:users.view']);
       Route::post('/', 'create')->name('create')->middleware(['can:users.create']);
       Route::put('/{id}', 'update')->name('update')->middleware(['can:users.update']);
       Route::delete('/{id}', 'delete')->name('delete')->middleware(['can:users.delete']);
    });
