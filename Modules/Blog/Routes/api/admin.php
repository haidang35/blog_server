<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\Admin\BlogController;
use Modules\Blog\Http\Controllers\Admin\BlogCategoryController;

Route::middleware(['auth:sanctum'])->prefix('blogs')->name('admin.blogs.')->controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:blogs.view');
    Route::get('/{id}', 'show')->name('show')->middleware('can:blogs.view');
    Route::post('/', 'create')->name('create')->middleware('can:blogs.create');
    Route::put('/{id}', 'update')->name('update')->middleware('can:blogs.update');
    Route::delete('/multiple', 'deleteBlogs')->name('deleteBlogs')->middleware('can:blogs.delete');
    Route::delete('/{id}', 'delete')->name('delete')->middleware('can:blogs.delete');
});

Route::middleware(['auth:sanctum'])->prefix('blog-categories')->name('admin.blog_categories.')->controller(BlogCategoryController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:blog_categories.view');
    Route::get('/{id}', 'show')->name('show')->middleware('can:blog_categories.view');
    Route::post('/', 'create')->name('create')->middleware('can:blog_categories.create');
    Route::put('/{id}', 'update')->name('update')->middleware('can:blog_categories.update');
    Route::delete('/multiple', 'deleteCategories')->name('deleteCategories')->middleware('can:blog_categories.delete');
//    Route::delete('/{id}', 'delete')->name('delete')->middleware('can:blog_categories.delete');
});
