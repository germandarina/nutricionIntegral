<?php

namespace App\Models\Traits\Relationship;

use App\Models\Patient;
use App\Models\PlanDetail;

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
}
