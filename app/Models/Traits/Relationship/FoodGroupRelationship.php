<?php

namespace App\Models\Traits\Relationship;


use App\Models\Patient;

/**
 * Class PatientRelationship.
 */
trait FoodGroupRelationship
{
    public function patients()
    {
        return $this->belongsToMany(Patient::class,'food_group_patient');
    }

}
