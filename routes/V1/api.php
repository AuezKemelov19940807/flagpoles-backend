<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController;



Route::prefix('v1')->group(function () {
  Route::controller(CategoryController::class)->group(function () {
      Route::prefix('category')
          ->name('api.v1.category.')
          ->group(function () {
          Route::get('/', 'index')->name('index');
          Route::get('/{category}', 'show')->name('show');
      });
  });
});
