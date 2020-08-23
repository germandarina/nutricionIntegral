<?php

namespace App\Models\Traits\Method;

/**
 * Trait FoodMethod.
 */
trait FoodMethod
{
    public static function boot(){
        parent::boot();

        static::updated(function ($model){
            $ingredients = $model->ingredients;
            foreach ($ingredients as $ingredient){
                $ingredient->touch();
                $ingredient->update();
            }
        });
    }

}
