<?php

use App\Http\Controllers\Backend\Admin\FoodGroupController;

Route::get('food-group/deleted', [FoodGroupController::class, 'getDeleted'])->name('food-group.deleted');
Route::get('food-group', [FoodGroupController::class, 'index'])->name('food-group.index');
Route::get('food-group/create', [FoodGroupController::class, 'create'])->name('food-group.create');
Route::post('food-group', [FoodGroupController::class, 'store'])->name('food-group.store');

Route::group(['prefix' => 'food-group/{food_group}'], function () {
    Route::get('edit', [FoodGroupController::class, 'edit'])->name('food-group.edit');
    Route::patch('/', [FoodGroupController::class, 'update'])->name('food-group.update');
    Route::post('destroy', [FoodGroupController::class, 'destroy'])->name('food-group.destroy');
    Route::post('restore', [FoodGroupController::class, 'restore'])->name('food-group.restore');
});
