<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\Illuminate\Support\Facades\Route::get('/reset-mail', function() {
   $token = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
    ->first();
   return new \Modules\Auth\Emails\SendResetPasswordLink('#', 'nguyenhaidangyq@gmail.com');
});


