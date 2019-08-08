<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient query()
 * @mixin \Eloquent
 */
class Patient extends BaseModel
{
    public $table = 'patients';

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
