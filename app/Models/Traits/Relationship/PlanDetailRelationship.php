<?php

namespace App\Models\Traits\Relationship;

use App\Models\Plan;
use App\Models\Recipe;

/**
 * Class PlanDetailRelationship.
 */
trait PlanDetailRelationship
{

    public function plan(){
        return $this->belongsTo(Plan::class,'plan_id');
    }

    public function recipe(){
        return $this->belongsTo(Recipe::class,'recipe_id');
    }

}
