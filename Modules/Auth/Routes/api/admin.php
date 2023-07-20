<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\TokenAbility;
use Modules\Auth\Http\Controllers\Admin\AuthController;
use Modules\Auth\Http\Controllers\Admin\RoleController;
use Modules\Auth\Http\Controllers\Admin\PermissionController;

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
    Route::post('/forgot-password', 'forgotPassword')->name('forgotPassword');
    Route::post('/reset-password', 'resetPassword')->name('resetPassword');
    Route::post('/reset-password/verify', 'verifyResetPassword')->name('verifyResetPassword');
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/my-account', 'getMyAccount')->name('getMyAccount');
        Route::post('/refresh-token', 'refreshToken')->name('refreshToken')->middleware(['ability:'. TokenAbility::ISSUE_ACCESS_TOKEN->value]);

        //Role
        Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function() {
            Route::get('/', 'getList')->name('getList');
            Route::post('/', 'create')->name('create');
            Route::delete('/{id}', 'delete')->name('delete');
            Route::put('/{id}', 'update')->name('update');
            Route::post('/{id}/permissions', 'assigningPermissionsToRole')->name('assigningPermissionsToRole');
        });

        //Permission
        Route::prefix('permissions')->name('permissions.')->controller(PermissionController::class)->group(function() {
            Route::get('/', 'getList')->name('getList');
            Route::post('/', 'create')->name('create');
            Route::delete('/{id}', 'delete')->name('delete');
            Route::put('/{id}', 'update')->name('update');
        });
    });
});
