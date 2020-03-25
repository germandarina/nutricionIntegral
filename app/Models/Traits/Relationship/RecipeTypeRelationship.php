<?php

namespace App\Models\Traits\Relationship;



use App\Models\Recipe;

/**
 * Class RecipeTypeRelationship.
 */
trait RecipeTypeRelationship
{
    public function recipe(){
        return $this->belongsTo(Recipe::class,'recipes');
    }
}
