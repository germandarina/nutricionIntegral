<?php

namespace App\Models\Traits\Method;

use App\Models\Food;
use App\Models\Ingredient;
use App\Models\Recipe;

/**
 * Trait IngredientMethod.
 */
trait IngredientMethod
{
    public static function boot(){
        parent::boot();

        static::created(function ($model) {
            self::updateRecipe($model->recipe,$model,$model->food);
        });

        static::updated(function ($model){
            $recipe = $model->recipe;
            self::defaultTotalValuesForRecipe($recipe);
            $ingredients = $recipe->ingredients;
            foreach ($ingredients as $ingredient){
                self::updateRecipe($recipe,$ingredient,$ingredient->food);
            }
        });

        static::deleted(function ($model){
            $recipe = $model->recipe;
            self::defaultTotalValuesForRecipe($recipe);
            $ingredients =  Ingredient::where('recipe_id',$recipe->id)
                                        ->where('id','<>',$model->id)
                                        ->whereNull('deleted_at')
                                        ->with('food')
                                        ->get();
            foreach ($ingredients as $ingredient){
                self::updateRecipe($recipe,$ingredient,$ingredient->food);
            }
        });
    }
    private static function defaultTotalValuesForRecipe(Recipe &$recipe){
        $recipe->total_energia_kcal = 0;
        $recipe->total_agua = 0;
        $recipe->total_proteina = 0;
        $recipe->total_grasa_total = 0;
        $recipe->total_carbohidratos_totales = 0;
        $recipe->total_cenizas = 0;
        $recipe->total_sodio = 0;
        $recipe->total_potasio = 0;
        $recipe->total_calcio = 0;
        $recipe->total_fosforo = 0;
        $recipe->total_hierro = 0;
        $recipe->total_zinc = 0;
        $recipe->total_tiamina = 0;
        $recipe->total_rivoflavina = 0;
        $recipe->total_niacina = 0;
        $recipe->total_vitamina_c = 0;
        $recipe->total_carbohidratos_disponibles = 0;
        $recipe->total_ac_grasos_saturados = 0;
        $recipe->total_ac_grasos_monoinsaturados = 0;
        $recipe->total_ac_grasos_poliinsaturados = 0;
        $recipe->total_fibra = 0;
        $recipe->total_colesterol = 0;
        $recipe->save();
    }
    private static function updateRecipe(Recipe &$recipe,Ingredient $ingredient,Food $food){

        $recipe->total_energia_kcal += $food->energia_kcal >0 ? round((($ingredient->quantity_grs *  $food->energia_kcal)/100),3) : 0;
        $recipe->total_agua += $food->agua >0 ? round((( $ingredient->quantity_grs * $food->agua)/100),3)  : 0;
        $recipe->total_proteina += $food->protenia >0 ? round((( $ingredient->quantity_grs * $food->proteina)/100),3)  : 0;
        $recipe->total_grasa_total += $food->grasa_total >0 ? round((( $ingredient->quantity_grs * $food->grasa_total)/100),3)  : 0;
        $recipe->total_carbohidratos_totales += $food->carbohidratos_totales >0 ? round((( $ingredient->quantity_grs * $food->carbohidratos_totales)/100),3)  : 0;
        $recipe->total_cenizas += $food->cenizas >0 ? round((( $ingredient->quantity_grs * $food->cenizas)/100),3)  : 0;
        $recipe->total_sodio += $food->sodio >0 ? round((( $ingredient->quantity_grs * $food->sodio)/100),3)  : 0;
        $recipe->total_potasio += $food->potasio >0 ? round((( $ingredient->quantity_grs * $food->potasio)/100),3)  : 0;
        $recipe->total_calcio += $food->calcio >0 ? round((( $ingredient->quantity_grs * $food->calcio)/100),3)  : 0;
        $recipe->total_fosforo += $food->fosforo >0 ? round((( $ingredient->quantity_grs * $food->fosforo)/100),3)  : 0;
        $recipe->total_hierro += $food->hierro >0 ? round((( $ingredient->quantity_grs * $food->hierro)/100),3)  : 0;
        $recipe->total_zinc += $food->zinc >0 ? round((( $ingredient->quantity_grs * $food->zinc)/100),3)  : 0;
        $recipe->total_tiamina += $food->tiamina >0 ? round((( $ingredient->quantity_grs * $food->tiamina)/100),3)  : 0;
        $recipe->total_rivoflavina += $food->rivoflavina >0 ? round((( $ingredient->quantity_grs * $food->rivoflavina)/100),3)  : 0;
        $recipe->total_niacina += $food->niacina >0 ? round((( $ingredient->quantity_grs * $food->niacina)/100),3)  : 0;
        $recipe->total_vitamina_c += $food->vitamina_c >0 ? round((( $ingredient->quantity_grs * $food->vitamina_c)/100),3)  : 0;
        $recipe->total_carbohidratos_disponibles += $food->carbohidratos_disponibles >0 ? round((( $ingredient->quantity_grs * $food->carbohidratos_disponibles)/100),3)  : 0;
        $recipe->total_ac_grasos_saturados += $food->ac_grasos_saturados >0 ? round((( $ingredient->quantity_grs * $food->ac_grasos_saturados)/100),3)  : 0;
        $recipe->total_ac_grasos_monoinsaturados += $food->ac_grasos_monoinsaturados >0 ? round((( $ingredient->quantity_grs * $food->ac_grasos_monoinsaturados)/100),3)  : 0;
        $recipe->total_ac_grasos_poliinsaturados += $food->ac_grasos_poliinsaturados >0 ? round((( $ingredient->quantity_grs * $food->ac_grasos_poliinsaturados)/100),3)  : 0;
        $recipe->total_fibra += $food->fibra >0 ? round((( $ingredient->quantity_grs * $food->fibra)/100),3)  : 0;
        $recipe->total_colesterol += $food->colesterol >0 ? round((( $ingredient->quantity_grs *$food->colesterol)/100),3)  : 0;
        $recipe->save();
    }
}
