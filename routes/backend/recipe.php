<?php


use App\Http\Controllers\Backend\Admin\RecipeController;

Route::get('recipe/deleted', [RecipeController::class, 'getDeleted'])->name('recipe.deleted');
Route::get('recipe', [RecipeController::class, 'index'])->name('recipe.index');
Route::get('recipe/create', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('recipe', [RecipeController::class, 'store'])->name('recipe.store');

Route::group(['prefix' => 'recipe/{recipe}'], function () {
    Route::get('edit', [RecipeController::class, 'edit'])->name('recipe.edit');
    Route::patch('/', [RecipeController::class, 'update'])->name('recipe.update');
    Route::post('destroy', [RecipeController::class, 'destroy'])->name('recipe.destroy');
    Route::post('restore', [RecipeController::class, 'restore'])->name('recipe.restore');
    Route::get('/get-ingredients', [RecipeController::class, 'getIngredients'])->name('recipe.getIngredients');
});
