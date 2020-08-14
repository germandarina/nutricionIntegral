<?php

namespace App\Models\Traits\Method;

/**
 * Trait RecipeTypeMethod.
 */
trait RecipeTypeMethod
{
    public static function getIdByName($name){
        $recipe_type = self::where('name',$name)->first();
        return $recipe_type->id;
    }

}
