<?php

use App\Http\Controllers\Backend\Admin\PlanController;

Route::get('plan/deleted', [PlanController::class, 'getDeleted'])->name('plan.deleted');
Route::get('plan', [PlanController::class, 'index'])->name('plan.index');
Route::get('plan/create', [PlanController::class, 'create'])->name('plan.create');
Route::post('plan', [PlanController::class, 'store'])->name('plan.store');
Route::post('plan/recipes-for-plan', [PlanController::class, 'getRecipesForPlan'])->name('plan.getRecipesForPlan');
Route::post('plan/modal-recipe', [PlanController::class, 'getModalRecipe'])->name('plan.getModalRecipe');
Route::post('plan/add-recipe-to-plan', [PlanController::class, 'addRecipeToPlan'])->name('plan.addRecipeToPlan');
Route::delete('plan/delete-detail', [PlanController::class, 'deleteDetail'])->name('plan.deleteDetail');
Route::delete('plan/delete-detail-by-day', [PlanController::class, 'deleteDetailByDay'])->name('plan.deleteDetailByDay');
Route::post('plan/total-completo-plan-por-dia', [PlanController::class, 'getTotalCompletoPlanPorDia'])->name('plan.getTotalCompletoPlanPorDia');
Route::post('plan/recipe-to-edit', [PlanController::class, 'getRecipe'])->name('plan.getRecipe');

Route::post('plan/store-order-plan-datail-day',[PlanController::class,'storeOrderPlanDetailDay'])->name('plan.storeOrderPlanDetailDay');

Route::post('plan/edit-recipe-added',[PlanController::class,'editRecipeAdded'])->name('plan.editRecipeAdded');
Route::post('plan/update-recipe-name',[PlanController::class,'updateRecipeName'])->name('plan.updateRecipeName');
Route::post('plan/calculate-energy-spending',[PlanController::class,'calculateEnergySpending'])->name('plan.calculateEnergySpending');

Route::delete('delete-activity-fao',[PlanController::class,'deleteActivityFao'])->name('plan.deleteActivityFao');

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
    Route::post('close-plan',[PlanController::class,'closePlan'])->name('plan.closePlan');
    Route::post('re-open-plan',[PlanController::class,'openPlan'])->name('plan.openPlan');

    Route::post('store-spending-energy',[PlanController::class,'storeEnergySpending'])->name('plan.storeEnergySpending');
    Route::post('store-activity-fao',[PlanController::class,'storeActivityFao'])->name('plan.storeActivityFao');
    Route::get('get-energy-spending',[PlanController::class,'getEnergySpending'])->name('plan.getEnergySpending');

    Route::post('get-amm-values',[PlanController::class,'getAMMValues'])->name('plan.getAMMValues');

    Route::post('get-total-activities-fao',[PlanController::class,'getTotalActivitiesFao'])->name('plan.getTotalActivitiesFao');

});
