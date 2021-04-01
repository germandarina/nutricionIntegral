<?php

use App\Http\Controllers\Backend\Admin\ObservationController;

Route::get('observation/deleted', [ObservationController::class, 'getDeleted'])->name('observation.deleted');
Route::get('observation', [ObservationController::class, 'index'])->name('observation.index');
Route::get('observation/create', [ObservationController::class, 'create'])->name('observation.create');
Route::post('observation', [ObservationController::class, 'store'])->name('observation.store');

Route::group(['prefix' => 'observation/{observation}'], function () {
    Route::get('edit', [ObservationController::class, 'edit'])->name('observation.edit');
    Route::patch('/', [ObservationController::class, 'update'])->name('observation.update');
    Route::post('destroy', [ObservationController::class, 'destroy'])->name('observation.destroy');
    Route::post('restore', [ObservationController::class, 'restore'])->name('observation.restore');
});
