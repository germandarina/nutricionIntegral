<?php

namespace App\Models;

use App\Models\Traits\Method\IngredientMethod;
use App\Models\Traits\Relationship\IngredientRelationship;


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
 * @property int $id
 * @property int $recipe_id
 * @property int $food_id
 * @property string $quantity_description
 * @property float|null $quantity_grs
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereQuantityDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereQuantityGrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereUpdatedBy($value)
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
