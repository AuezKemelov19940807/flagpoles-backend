<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CatalogController;


Route::prefix('admin/catalog')
    ->name('admin.catalog.')
    ->group(function () {
        Route::controller(CatalogController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{category}', 'show')->name('show');
        });
    });

