<?php

namespace App\Models\Traits\Relationship;


use App\Models\Patient;

/**
 * Class FoodRelationship.
 */
trait FoodRelationship
{
    public function patients()
    {
        return $this->belongsToMany(Patient::class,'food_patient');
    }

}
