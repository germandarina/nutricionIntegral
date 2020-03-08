<?php

use App\Http\Controllers\Backend\Admin\FoodController;

Route::get('food/importarAlimentos', [FoodController::class, 'importarAlimentos'])->name('food.importarAlimentos');
Route::get('food/deleted', [FoodController::class, 'getDeleted'])->name('food.deleted');
Route::get('food', [FoodController::class, 'index'])->name('food.index');
Route::get('food/create', [FoodController::class, 'create'])->name('food.create');
Route::post('food', [FoodController::class, 'store'])->name('food.store');

Route::group(['prefix' => 'food/{food}'], function () {
    Route::get('edit', [FoodController::class, 'edit'])->name('food.edit');
    Route::patch('/', [FoodController::class, 'update'])->name('food.update');
    Route::post('destroy', [FoodController::class, 'destroy'])->name('food.destroy');
    Route::post('restore', [FoodController::class, 'restore'])->name('food.restore');
});
