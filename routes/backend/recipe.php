<?php


use App\Http\Controllers\Backend\Admin\PatientController;

Route::get('patient/deleted', [PatientController::class, 'getDeleted'])->name('patient.deleted');
Route::get('patient', [PatientController::class, 'index'])->name('patient.index');
Route::get('patient/create', [PatientController::class, 'create'])->name('patient.create');
Route::post('patient', [PatientController::class, 'store'])->name('patient.store');

Route::group(['prefix' => 'patient/{patient}'], function () {
    Route::get('edit', [PatientController::class, 'edit'])->name('patient.edit');
    Route::patch('/', [PatientController::class, 'update'])->name('patient.update');
    Route::post('destroy', [PatientController::class, 'destroy'])->name('patient.destroy');
    Route::post('restore', [PatientController::class, 'restore'])->name('patient.restore');
});
