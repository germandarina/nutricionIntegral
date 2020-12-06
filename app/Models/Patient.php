<?php

namespace App\Models;

use App\Models\Traits\Method\PatientMethod;
use App\Models\Traits\Relationship\PatientRelationship;

class Patient extends BaseModel
{
    use PatientMethod,
        PatientRelationship;

    public $table = 'patients';
    protected $columns_full_text  = ['full_name','document'];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'birthdate',
    ];

    protected $fillable = [
        'full_name',
        'birthdate',
        'age',
        'document',
        'address',
        'phone',
        'email',
        'motive',
        'number_of_children',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const gender_masc = 1;
    const gender_fem  = 2;

    public static $genders = [
        self::gender_masc   => 'Masculino',
        self::gender_fem    => 'Femenino',
    ];
}
