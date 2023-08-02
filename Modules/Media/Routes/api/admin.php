<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\Admin\MediaController;

Route::prefix('media')->name('media')->controller(MediaController::class)->group(function () {
   Route::get('/items', 'getAllMediaItems')->name('getAllMediaItems');
   Route::post('/upload/images', 'uploadMediaFiles')->name('uploadMediaItems');
});

