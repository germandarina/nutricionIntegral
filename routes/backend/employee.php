<?php

use App\Http\Controllers\Backend\Admin\EmployeeController;

Route::get('employee/deleted', [EmployeeController::class, 'getDeleted'])->name('employee.deleted');
Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee', [EmployeeController::class, 'store'])->name('employee.store');

Route::group(['prefix' => 'employee/{employee}'], function () {
    Route::get('edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::patch('/', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('destroy', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::post('restore', [EmployeeController::class, 'restore'])->name('employee.restore');
});