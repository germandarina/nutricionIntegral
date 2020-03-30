<?php

namespace App\Models\Traits\Relationship;



use App\Models\Food;
use App\Models\Recipe;

/**
 * Class IngredientRelationship.
 */
trait IngredientRelationship
{
    public function recipe(){
        return $this->belongsTo(Recipe::class,'recipe_id');
    }

    public function food(){
        return $this->belongsTo(Food::class,'food_id');
    }
}
