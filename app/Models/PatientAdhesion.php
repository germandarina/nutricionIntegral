<?php

namespace App\Models;

use App\Models\Traits\Relationship\PatientAdhesionRelationship;

class PatientAdhesion extends BaseModel
{
    use PatientAdhesionRelationship;

    public $table = 'patient_adhesions';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'patient_id',
        'patient_control_id',
        'adhesion',
        'real_hungry',
        'emocional_hungry',
        'training_adhesion',
        'training_performance',
        'dream',
        'stress',
        'organization',
        'alcohol',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
