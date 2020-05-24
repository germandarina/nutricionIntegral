<?php

use App\Http\Controllers\Backend\Admin\PlanController;

Route::get('plan/deleted', [PlanController::class, 'getDeleted'])->name('plan.deleted');
Route::get('plan', [PlanController::class, 'index'])->name('plan.index');
Route::get('plan/create', [PlanController::class, 'create'])->name('plan.create');
Route::post('plan', [PlanController::class, 'store'])->name('plan.store');
Route::post('get-recipes-for-plan', [PlanController::class, 'getRecipesForPlan'])->name('plan.getRecipesForPlan');
Route::post('get-modal-recipe', [PlanController::class, 'getModalRecipe'])->name('plan.getModalRecipe');
Route::post('add-recipe-to-plan', [PlanController::class, 'addRecipeToPlan'])->name('plan.addRecipeToPlan');
Route::delete('delete-detail', [PlanController::class, 'deleteDetail'])->name('plan.deleteDetail');

Route::group(['prefix' => 'plan/{plan}'], function () {
    Route::get('edit', [PlanController::class, 'edit'])->name('plan.edit');
    Route::patch('/', [PlanController::class, 'update'])->name('plan.update');
    Route::post('destroy', [PlanController::class, 'destroy'])->name('plan.destroy');
    Route::post('restore', [PlanController::class, 'restore'])->name('plan.restore');
    Route::get('add-recipes', [PlanController::class, 'addRecipes'])->name('plan.addRecipes');
    Route::get('get-recipes', [PlanController::class, 'getRecipes'])->name('plan.getRecipes');
});
