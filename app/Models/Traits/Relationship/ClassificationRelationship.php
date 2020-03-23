<?php

namespace App\Models\Traits\Relationship;



use App\Models\Patient;
use App\Models\Recipe;

/**
 * Class PatientRelationship.
 */
trait ClassificationRelationship
{

    public function patients(){
        return $this->hasOne(Patient::class,'classification_patient');
    }

    public function recipes(){
        return $this->belongsToMany(Recipe::class,'classfication_recipe');
    }
}
