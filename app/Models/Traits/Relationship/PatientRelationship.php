<?php

namespace App\Models\Traits\Relationship;



use App\Models\Classification;
use App\Models\Food;
use App\Models\FoodGroup;
use App\Models\Plan;
use App\Models\Recommendation;

/**
 * Class PatientRelationship.
 */
trait PatientRelationship
{
    public function foods()
    {
        return $this->belongsToMany(Food::class,'food_patient','patient_id');
    }

    public function foodGroups()
    {
        return $this->belongsToMany(FoodGroup::class,'food_group_patient','patient_id');
    }

    public function plans(){
        return $this->hasMany(Plan::class,'patient_id');
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class,'classification_patient','patient_id');
    }

    public function recommendations()
    {
        return $this->belongsToMany(Recommendation::class,'basic_information_recommendation_patient','patient_id')
                        ->orderBy('origin','asc');
    }
}
