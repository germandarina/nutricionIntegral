<?php

namespace App\Models\Traits\Relationship;

use App\Models\Patient;
use App\Models\PlanDetail;
use App\Models\PlanDetailDay;

/**
 * Class PlanRelationship.
 */
trait PlanRelationship
{

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function details(){
        return $this->hasMany(PlanDetail::class,'plan_id');
    }

    public function detailsDays(){
        return $this->hasMany(PlanDetailDay::class,'plan_id');
    }
}
