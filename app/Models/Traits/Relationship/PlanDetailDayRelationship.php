<?php

namespace App\Models\Traits\Relationship;

use App\Models\Plan;
use App\Models\PlanDetail;
use App\Models\PlanDetailDay;
use App\Models\Recipe;

/**
 * Class PlanDetailRelationship.
 */
trait PlanDetailDayRelationship
{
    public function planDetail(){
        return $this->belongsTo(PlanDetail::class,'plan_detail_id');
    }
}
