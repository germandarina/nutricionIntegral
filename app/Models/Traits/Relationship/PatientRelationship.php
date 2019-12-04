<?php

namespace App\Models\Traits\Relationship;



use App\Models\Food;
use App\Models\FoodGroup;

/**
 * Class PatientRelationship.
 */
trait PatientRelationship
{
    public function foods()
    {
        return $this->belongsToMany(Food::class,'food_patient');
    }

    public function foodGroups()
    {
        return $this->belongsToMany(FoodGroup::class,'food_group_patient');
    }

}
