<?php


use App\Http\Controllers\Backend\Admin\RecipeController;

Route::get('recipe/deleted', [RecipeController::class, 'getDeleted'])->name('recipe.deleted');
Route::get('recipe', [RecipeController::class, 'index'])->name('recipe.index');
Route::get('recipe/create', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('recipe', [RecipeController::class, 'store'])->name('recipe.store');
Route::get('recipe/search-ingredients', [RecipeController::class, 'searchIngredients'])->name('recipe.searchIngredients');
Route::delete('recipe/delete-ingredient', [RecipeController::class, 'deleteIngredient'])->name('recipe.deleteIngredient');
Route::post('recipe/get-ingredient', [RecipeController::class, 'getIngredient'])->name('recipe.getIngredient');
Route::post('recipe/get-total', [RecipeController::class, 'getTotal'])->name('recipe.getTotal');
Route::post('recipe/get-total-completo', [RecipeController::class, 'getTotalCompleto'])->name('recipe.getTotalCompleto');
Route::get('recipe/get-ingredients', [RecipeController::class, 'getIngredients'])->name('recipe.getIngredients');
Route::post('recipe/add-ingredients', [RecipeController::class, 'addIngredients'])->name('recipe.addIngredients');
Route::post('recipe/calculate-grs', [RecipeController::class, 'calculateGrs'])->name('recipe.calculateGrs');


Route::group(['prefix' => 'recipe/{recipe}'], function () {
    Route::get('edit', [RecipeController::class, 'edit'])->name('recipe.edit');
    Route::patch('/', [RecipeController::class, 'update'])->name('recipe.update');
    Route::post('destroy', [RecipeController::class, 'destroy'])->name('recipe.destroy');
    Route::post('restore', [RecipeController::class, 'restore'])->name('recipe.restore');
    Route::post('copy-recipe', [RecipeController::class, 'copyRecipe'])->name('recipe.copyRecipe');
});
