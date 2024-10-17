<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CatalogController;
use App\Http\Controllers\Api\V1\ItemController;


Route::prefix('v1')->group(function () {
  Route::controller(CatalogController::class)->group(function () {
      Route::prefix('catalog')
          ->name('api.v1.catalog.')
          ->group(function () {
          Route::get('/', 'index')->name('index');
          Route::get('/{catalog:slug}', 'slug')->name('slug');
      });
  });

    // Добавьте маршруты для ItemController
    Route::controller(ItemController::class)->group(function () {
        Route::prefix('items') // Префикс для маршрутов items
        ->name('api.v1.items.')
            ->group(function () {
                Route::get('/{slug}', 'show')->name('show'); // Маршрут для получения элемента по slug
            });
    });

});
