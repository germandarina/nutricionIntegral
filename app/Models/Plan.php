<?php

namespace App\Models;

use App\Models\Traits\Method\PlanMethod;
use App\Models\Traits\Relationship\RecipeRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read \App\Models\RecipeType $recipeType
 */
class Plan extends BaseModel
{
    use PlanMethod,
        RecipeRelationship;

    public $table = 'plans';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'patient_id',
        'days',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
