<?php

namespace App\Models\Traits\Relationship;

use App\Models\Observation;
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

    public function observations(){
        return $this->belongsToMany(Observation::class,'observation_plan_detail','plan_detail_id');
    }
}
