<?php

namespace App\Models;

use App\Models\Traits\Method\RecipeTypeMethod;
use App\Models\Traits\Relationship\RecipeTypeRelationship;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\RecipeType
 *
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 */
class RecipeType extends BaseModel
{
    use RecipeTypeMethod,
        RecipeTypeRelationship;

    public $table = 'recipe_types';

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
