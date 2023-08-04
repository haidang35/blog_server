<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\Admin\MediaController;

Route::prefix('media')->name('media')
    ->controller(MediaController::class)->group(function () {
    Route::get('/items', 'getAllMediaItems')->name('getAllMediaItems')->middleware('can:media,view');
    Route::delete('/items/multiple', 'deleteMediaItems')->name('deleteMediaItems')->middleware('can:media,delete');
    Route::delete('/items/{id}', 'deleteSingleMediaItem')->name('deleteSingleMediaItem')->middleware('can:media,delete');
    Route::post('/upload/images', 'uploadMediaFiles')->name('uploadMediaItems')->middleware('can:media,upload');;
})->middleware(['auth:sanctum', 'can:media.*']);

