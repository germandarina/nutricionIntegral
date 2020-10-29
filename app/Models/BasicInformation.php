<?php

namespace App\Models;

use App\Models\Traits\Method\BasicInformationMethod;
use App\Models\Traits\Relationship\BasicInformationRelationship;

class BasicInformation extends BaseModel
{
    use BasicInformationRelationship,
        BasicInformationMethod;

    public $table = 'basic_information';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_name',
        'address',
        'email',
        'm_professional',
        'company_name',
        'path_image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
