<?php

namespace App\Models;

use App\Models\Traits\Relationship\PatientControlRelationship;

class PatientControl extends BaseModel
{
    use PatientControlRelationship;

    public $table = 'patient_controls';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'period',
    ];

    protected $fillable = [
        'period',
        'patient_id',
        'height',
        'weight',
        'waist',
        'hips',
        'muscle_kg',
        'fat_kg',
        'muscle_percent',
        'fat_percent',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
