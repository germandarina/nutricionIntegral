<?php

use App\Http\Controllers\Backend\Admin\PlanController;

Route::get('plan/deleted', [PlanController::class, 'getDeleted'])->name('plan.deleted');
Route::get('plan', [PlanController::class, 'index'])->name('plan.index');
Route::get('plan/create', [PlanController::class, 'create'])->name('plan.create');
Route::post('plan', [PlanController::class, 'store'])->name('plan.store');
Route::post('recipes-for-plan', [PlanController::class, 'getRecipesForPlan'])->name('plan.getRecipesForPlan');
Route::post('modal-recipe', [PlanController::class, 'getModalRecipe'])->name('plan.getModalRecipe');
Route::post('add-recipe-to-plan', [PlanController::class, 'addRecipeToPlan'])->name('plan.addRecipeToPlan');
Route::delete('delete-detail', [PlanController::class, 'deleteDetail'])->name('plan.deleteDetail');
//Route::post('add-plan-detail-day', [PlanController::class, 'addPlanDetailDay'])->name('plan.addPlanDetailDay');
Route::delete('delete-detail-by-day', [PlanController::class, 'deleteDetailByDay'])->name('plan.deleteDetailByDay');
Route::post('total-completo-plan-por-dia', [PlanController::class, 'getTotalCompletoPlanPorDia'])->name('plan.getTotalCompletoPlanPorDia');
//Route::post('total-completo-por-plan',[PlanController::class,'getTotalComposionPorPlan'])->name('plan.getTotalComposionPorPlan');
Route::post('recipe-to-edit', [PlanController::class, 'getRecipe'])->name('plan.getRecipe');

Route::post('store-order-plan-datail-day',[PlanController::class,'storeOrderPlanDetailDay'])->name('plan.storeOrderPlanDetailDay');

Route::group(['prefix' => 'plan/{plan}'], function () {
    Route::get('edit', [PlanController::class, 'edit'])->name('plan.edit');
    Route::patch('/', [PlanController::class, 'update'])->name('plan.update');
    Route::post('destroy', [PlanController::class, 'destroy'])->name('plan.destroy');
    Route::post('restore', [PlanController::class, 'restore'])->name('plan.restore');
    Route::get('add-recipes', [PlanController::class, 'addRecipes'])->name('plan.addRecipes');
    Route::get('recipes', [PlanController::class, 'getRecipes'])->name('plan.getRecipes');
    Route::get('recipes-by-day', [PlanController::class, 'getRecipesByDay'])->name('plan.getRecipesByDay');
    Route::post('total-recipes-by-day',[PlanController::class,'getTotalRecipesByDay'])->name('plan.getTotalRecipesByDay');
    Route::get('download-plan',[PlanController::class,'downloadPlan'])->name('plan.downloadPlan');
});
