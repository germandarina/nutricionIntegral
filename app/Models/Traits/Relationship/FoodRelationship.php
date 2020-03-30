<?php

namespace App\Models\Traits\Relationship;


use App\Models\FoodGroup;
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

    public function foodGroup(){
        return $this->belongsTo(FoodGroup::class,'food_group_id');
    }
}
