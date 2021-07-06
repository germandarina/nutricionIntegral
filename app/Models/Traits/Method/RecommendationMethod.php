<?php

namespace App\Models\Traits\Method;

/**
 * Trait RecommendationMethod.
 */
trait RecommendationMethod
{
    public function getPatientsFrontAttribute()
    {
        if(!$this->patients)
            $this->load('patients');

        $patients = "";
        $names_patients = $this->patients->pluck('full_name')->toArray();
        if($names_patients)
        {
            $patients = implode(',',$names_patients);
        }

        return trim($patients);
    }
}
