<?php

use App\Http\Controllers\Backend\Admin\PatientController;

Route::get('patient/deleted', [PatientController::class, 'getDeleted'])->name('patient.deleted');
Route::get('patient', [PatientController::class, 'index'])->name('patient.index');
Route::get('patient/create', [PatientController::class, 'create'])->name('patient.create');
Route::post('patient', [PatientController::class, 'store'])->name('patient.store');
Route::get('patient/search-patients', [PatientController::class, 'searchPatients'])->name('patient.searchPatients');
Route::post('patient/age', [PatientController::class, 'getAge'])->name('patient.getAge');

#control
Route::post('destroy-control', [PatientController::class, 'destroyControl'])->name('patient.destroyControl');
Route::post('get-control', [PatientController::class, 'getControl'])->name('patient.getControl');


Route::group(['prefix' => 'patient/{patient}'], function () {
    Route::get('edit', [PatientController::class, 'edit'])->name('patient.edit');
    Route::patch('/', [PatientController::class, 'update'])->name('patient.update');
    Route::post('destroy', [PatientController::class, 'destroy'])->name('patient.destroy');
    Route::post('restore', [PatientController::class, 'restore'])->name('patient.restore');

    ##  control
    Route::post('store-control', [PatientController::class, 'storeControl'])->name('patient.storeControl');
    Route::get('controls', [PatientController::class, 'controls'])->name('patient.controls');
    Route::post('control-graphics', [PatientController::class, 'controlGraphics'])->name('patient.controlGraphics');

});
