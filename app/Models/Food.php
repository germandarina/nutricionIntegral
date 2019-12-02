<?php

namespace App\Models;

use App\Models\Traits\Method\FoodMethod;
use App\Models\Traits\Relationship\FoodRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Food
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food query()
 * @mixin \Eloquent
 */
class Food extends BaseModel
{
    use FoodMethod,
        FoodRelationship;

    public $table = 'foods';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'food_group_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
