<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CatalogController;



Route::prefix('v1')->group(function () {
  Route::controller(CatalogController::class)->group(function () {
      Route::prefix('catalog')
          ->name('api.v1.catalog.')
          ->group(function () {
          Route::get('/', 'index')->name('index');
          Route::get('/{catalog:slug}', 'slug')->name('slug');
      });
  });
});
