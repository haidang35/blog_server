<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

Route::prefix('blogs')->name('public.blogs.')->controller(BlogController::class)->group(function () {
   Route::get('/', 'getBlogList')->name('getBlogList');
   Route::get('/{slug}', 'getSingleBlog')->name('getSingleBlog');
});
