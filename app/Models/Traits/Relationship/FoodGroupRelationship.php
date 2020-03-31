<?php

namespace App\Models\Traits\Relationship;


use App\Models\Patient;
use App\Models\Food;
/**
 * Class PatientRelationship.
 */
trait FoodGroupRelationship
{
    public function patients()
    {
        return $this->belongsToMany(Patient::class,'food_group_patient');
    }

    public function foods(){
        return $this->hasMany(Food::class,'food_group_id');
    }

}
