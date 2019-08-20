<?php

namespace App\Models\Traits\Relationship;

use App\Models\Patient;

/**
 * Class EmployeeRelationship.
 */
trait EmployeeRelationship
{

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'employee_patient')->withTimestamps();
    }
}
