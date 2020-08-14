<?php

namespace App\Models\Traits\Relationship;



use App\Models\Classification;
use App\Models\Ingredient;
use App\Models\PlanDetail;
use App\Models\RecipeType;

/**
 * Class RecipeRelationship.
 */
trait RecipeRelationship
{

    public function recipeType(){
        return $this->belongsTo(RecipeType::class,'recipe_type_id');
    }

    public function classifications(){
        return $this->belongsToMany(Classification::class,'classification_recipe','recipe_id');
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class,'recipe_id');
    }

    public function planDetails(){
        return $this->hasMany(PlanDetail::class,'recipe_id');
    }
}
