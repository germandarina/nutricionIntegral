<?php

namespace App\Models;

use App\Models\Traits\Method\IngredientMethod;
use App\Models\Traits\Relationship\IngredientRelationship;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Ingredient
 *
 * @property-read \App\Models\Ingredient $ingredient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient query()
 * @mixin \Eloquent
 * @property-read \App\Models\Food $food
 * @property-read \App\Models\Recipe $recipe
 */
class Ingredient extends BaseModel
{
    use IngredientMethod,
        IngredientRelationship;

    public $table = 'ingredients';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'recipe_id',
        'food_id',
        'quantity_description',
        'quantity_grs',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
