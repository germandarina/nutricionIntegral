<?php

namespace App\Models;


class BasicInformation extends BaseModel
{
    public $table = 'basic_information';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_name',
        'phone',
        'cellphone',
        'address',
        'email',
        'm_professional',
        'company_name',
        'path_logo',
        'path_image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
