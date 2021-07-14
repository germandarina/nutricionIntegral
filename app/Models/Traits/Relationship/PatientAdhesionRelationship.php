<?php

namespace App\Models\Traits\Relationship;

use App\Models\Patient;
use App\Models\PatientControl;

/**
 * Class PatientAdhesionRelationship.
 */
trait PatientAdhesionRelationship
{

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function control(){
        return $this->belongsTo(PatientControl::class,'patient_id');
    }
}
