<?php

use App\Http\Controllers\Backend\Admin\ClassificationController;

Route::get('classification/deleted', [ClassificationController::class, 'getDeleted'])->name('classification.deleted');
Route::get('classification', [ClassificationController::class, 'index'])->name('classification.index');
Route::get('classification/create', [ClassificationController::class, 'create'])->name('classification.create');
Route::post('classification', [ClassificationController::class, 'store'])->name('classification.store');

Route::group(['prefix' => 'classification/{classification}'], function () {
    Route::get('edit', [ClassificationController::class, 'edit'])->name('classification.edit');
    Route::patch('/', [ClassificationController::class, 'update'])->name('classification.update');
    Route::post('destroy', [ClassificationController::class, 'destroy'])->name('classification.destroy');
    Route::post('restore', [ClassificationController::class, 'restore'])->name('classification.restore');
});
