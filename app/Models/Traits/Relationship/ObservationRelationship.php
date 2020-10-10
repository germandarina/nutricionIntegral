<?php

namespace App\Models\Traits\Relationship;

use App\Models\Recipe;

/**
 * Class ObservationRelationship.
 */
trait ObservationRelationship
{
    public function recipes(){
        return $this->belongsToMany(Recipe::class,'observation_recipe','observation_id');
    }
}
