<?php

namespace App\Models\Traits\Relationship;


use App\Models\Patient;

/**
 * Class RecommendationRelationship.
 */
trait RecommendationRelationship
{
    public function patients()
    {
        return $this->belongsToMany(Patient::class,'basic_information_recommendation_patient','recommendation_id');
    }
}
