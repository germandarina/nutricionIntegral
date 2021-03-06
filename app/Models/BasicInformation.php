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
        'color_days',
        'color_headers',
        'color_observations',
        'show_frequency_days',
        'frequency_days',
        'template',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const template_minimalism = 1;
    const template_full_data  = 2;

    const show_frequency_days = 1;
    const dont_show_frequency_days = 0;

    public static $show_frequency = [
        self::show_frequency_days => 'Si',
        self::dont_show_frequency_days => 'No'
    ];
}
