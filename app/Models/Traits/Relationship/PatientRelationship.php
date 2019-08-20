<?php

namespace App\Models\Traits\Relationship;



use App\Models\Employee;

/**
 * Class PatientRelationship.
 */
trait PatientRelationship
{
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_patient')->withTimestamps();
    }
}
