<?php

namespace App\Models\Traits\Relationship;

use App\Models\Patient;
use App\Models\PlanDetail;
use App\Models\PlanEnergySpending;

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

    public function energySpendings()
    {
        return $this->hasMany(PlanEnergySpending::class,'plan_id');
    }
}
