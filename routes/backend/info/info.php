<?php


use App\Http\Controllers\Backend\DashboardController;

Route::get('download-manual', [DashboardController::class, 'downloadManual'])->name('downloadManual');
