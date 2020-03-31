<?php

namespace App\Models;

use App\Models\Traits\Method\RecipeMethod;
use App\Models\Traits\Relationship\RecipeRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read \App\Models\RecipeType $recipeType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 */
class Recipe extends BaseModel
{
    use RecipeMethod,
        RecipeRelationship;

    public $table = 'recipes';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'observation',
        'recipe_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
