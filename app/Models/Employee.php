<?php

namespace App\Models;

use App\Models\Traits\Method\EmployeeMethod;
use App\Models\Traits\Relationship\EmployeeRelationship;

/**
 * App\Models\Employee
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee query()
 * @mixin \Eloquent
 */
class Employee extends BaseModel
{
    use EmployeeMethod,
        EmployeeRelationship;

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
        'address',
        'phone',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
