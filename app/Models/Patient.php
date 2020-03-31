<?php

namespace App\Models;

use App\Models\Traits\Method\PatientMethod;
use App\Models\Traits\Relationship\PatientRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FoodGroup[] $foodGroups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plan[] $plans
 */
class Patient extends BaseModel
{
    use PatientMethod,
        PatientRelationship;

    public $table = 'patients';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
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
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
