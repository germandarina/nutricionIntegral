<?php

namespace App\Models;

use App\Models\Traits\Method\FoodGroupMethod;
use App\Models\Traits\Relationship\FoodGroupRelationship;

/**
 * App\Models\FoodGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 * @property int $id
 * @property string $name
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $foods_count
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereUpdatedBy($value)
 */
class FoodGroup extends BaseModel
{
    use FoodGroupMethod,
        FoodGroupRelationship;

    public $table = 'food_groups';

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
