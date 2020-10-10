<?php

namespace App\Models;

use App\Models\Traits\Method\ClassificationMethod;
use App\Models\Traits\Relationship\ClassificationRelationship;

class Classification extends BaseModel
{
    use ClassificationMethod,
        ClassificationRelationship;

    public $table = 'classifications';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'default_register',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
