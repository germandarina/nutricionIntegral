<?php

namespace App\Models\Traits\Relationship;

use App\Models\Patient;

/**
 * Class PatientControlRelationship.
 */
trait PatientControlRelationship
{

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
