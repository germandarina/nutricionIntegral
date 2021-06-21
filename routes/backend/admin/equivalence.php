<?php
use App\Http\Controllers\Backend\Admin\EquivalenceController;

Route::get('equivalence', [EquivalenceController::class, 'index'])->name('equivalence.index');
Route::post('equivalence/calculate', [EquivalenceController::class, 'calculate'])->name('equivalence.calculate');
