<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;


Route::prefix('admin/category')
    ->name('admin.category.')
    ->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{category}', 'show')->name('show');
        });
    });
