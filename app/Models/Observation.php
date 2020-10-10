<?php

namespace App\Models;

use App\Models\Traits\Method\ObservationMethod;
use App\Models\Traits\Relationship\ObservationRelationship;

class Observation extends BaseModel
{
    use ObservationMethod,
        ObservationRelationship;

    public $table = 'observations';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
