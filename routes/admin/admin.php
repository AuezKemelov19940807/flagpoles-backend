<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\CategoryController;



Route::prefix('admin')->group(function () {
    Route::controller(CatalogController::class)->group(function () {
        Route::prefix('catalog')
            ->name('admin.catalog.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{category}', 'show')->name('show');
            });
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::prefix('category')
            ->name('admin.category.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{category}', 'show')->name('show');
            });
    });
});

