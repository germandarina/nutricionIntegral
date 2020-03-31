<?php

namespace App\Models\Traits\Relationship;



use App\Models\Recipe;

/**
 * Class RecipeTypeRelationship.
 */
trait RecipeTypeRelationship
{
    public function recipes(){
        return $this->hasMany(Recipe::class,'recipe_type_id');
    }
}
