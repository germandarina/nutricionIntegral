<?php

use App\Http\Controllers\Backend\Admin\SocialWorkController;

Route::get('social-work/deleted', [SocialWorkController::class, 'getDeleted'])->name('social-work.deleted');
Route::get('social-work', [SocialWorkController::class, 'index'])->name('social-work.index');
Route::get('social-work/create', [SocialWorkController::class, 'create'])->name('social-work.create');
Route::post('social-work', [SocialWorkController::class, 'store'])->name('social-work.store');

Route::group(['prefix' => 'social-work/{social_work}'], function () {
    Route::get('edit', [SocialWorkController::class, 'edit'])->name('social-work.edit');
    Route::patch('/', [SocialWorkController::class, 'update'])->name('social-work.update');
    Route::post('destroy', [SocialWorkController::class, 'destroy'])->name('social-work.destroy');
    Route::post('restore', [SocialWorkController::class, 'restore'])->name('social-work.restore');
});