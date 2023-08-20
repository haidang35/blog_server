<?php


use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\MediaController;

Route::prefix('media')->name('media.')
    ->controller(MediaController::class)->group(function () {
        Route::get('/storage/{fileName}', 'getMediaFile')->name('getMediaFile');
    });

