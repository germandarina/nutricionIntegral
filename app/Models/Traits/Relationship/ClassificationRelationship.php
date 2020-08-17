<?php

namespace App\Models\Traits\Relationship;



use App\Models\Patient;
use App\Models\Recipe;

/**
 * Class ClassificationRelationship.
 */
trait ClassificationRelationship
{

    public function patients(){
        return $this->belongsToMany(Patient::class,'classification_patient','classification_id');
    }

    public function recipes(){
        return $this->belongsToMany(Recipe::class,'classification_recipe','classification_id');
    }
}
