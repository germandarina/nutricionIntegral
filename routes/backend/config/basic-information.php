<?php

use App\Http\Controllers\Backend\Admin\BasicInformationController;

Route::get('basic-information', [BasicInformationController::class, 'index'])->name('basic-information.index');
Route::get('basic-information/create', [BasicInformationController::class, 'create'])->name('basic-information.create');
Route::post('basic-information', [BasicInformationController::class, 'store'])->name('basic-information.store');

Route::post('basic-information/delete-phone/{phone}', [BasicInformationController::class, 'deletePhone'])->name('basic-information.deletePhone');
Route::post('basic-information/delete-recommendation/{recommendation}', [BasicInformationController::class, 'deleteRecommendation'])->name('basic-information.deleteRecommendation');
Route::get('basic-information/download-recommendation/{recommendation}', [BasicInformationController::class, 'downloadRecommendation'])->name('basic-information.downloadRecommendation');

Route::group(['prefix' => 'basic-information/{basic_information}'], function ()
{
    Route::get('edit', [BasicInformationController::class, 'edit'])->name('basic-information.edit');
    Route::patch('/', [BasicInformationController::class, 'update'])->name('basic-information.update');

    Route::get('get-phones', [BasicInformationController::class, 'getPhones'])->name('basic-information.getPhones');
    Route::post('store-phone', [BasicInformationController::class, 'storePhone'])->name('basic-information.storePhone');

    Route::get('get-recommendations', [BasicInformationController::class, 'getRecommendations'])->name('basic-information.getRecommendations');
    Route::post('store-recommendation', [BasicInformationController::class, 'storeRecommendation'])->name('basic-information.storeRecommendation');

    Route::post('store-colors', [BasicInformationController::class, 'storeColors'])->name('basic-information.storeColors');
    Route::get('download-plan-example', [BasicInformationController::class, 'downloadPlanExample'])->name('basic-information.downloadPlanExample');

});
