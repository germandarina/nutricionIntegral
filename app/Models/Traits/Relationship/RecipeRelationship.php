<?php

namespace App\Models\Traits\Relationship;



use App\Models\Classification;
use App\Models\RecipeType;

/**
 * Class RecipeRelationship.
 */
trait RecipeRelationship
{

    public function recipeType(){
        return $this->hasOne(RecipeType::class,'recipe_types');
    }

    public function classifications(){
        return $this->belongsToMany(Classification::class,'classification_recipe');
    }
}
