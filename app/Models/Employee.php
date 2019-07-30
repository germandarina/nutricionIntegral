<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends BaseModel
{
    public $table = 'employees';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'document',
        'adress',
        'phone',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
