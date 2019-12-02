<?php

namespace App\Models;

use App\Models\Traits\Method\FoodGroupMethod;
use App\Models\Traits\Relationship\FoodGroupRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FoodGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup query()
 * @mixin \Eloquent
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
