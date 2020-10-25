<?php

namespace App\Models;


class Phone extends BaseModel
{
    public $table = 'basic_information_phones';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'basic_information_id',
        'code_area',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
