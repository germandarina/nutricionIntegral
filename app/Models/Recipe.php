<?php

namespace App\Models;

use App\Models\Traits\Method\RecipeMethod;
use App\Models\Traits\Relationship\RecipeRelationship;

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
 * @property int $id
 * @property string $name
 * @property int $recipe_type_id
 * @property string $observation
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $classifications_count
 * @property-read int|null $ingredients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereRecipeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereUpdatedBy($value)
 */
class Recipe extends BaseModel
{
    use RecipeMethod,
        RecipeRelationship;

    public $table = 'recipes';
    protected $columns_full_text  = ['name'];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'observation',
        'recipe_type_id',
        'portions',
        'total_energia_kcal',
        'total_agua',
        'total_proteina',
        'total_grasa_total',
        'total_carbohidratos_totales',
        'total_cenizas',
        'total_sodio',
        'total_potasio',
        'total_calcio',
        'total_fosforo',
        'total_hierro',
        'total_zinc',
        'total_tiamina',
        'total_riboflavina',
        'total_niacina',
        'total_vitamina_c',
        'total_carbohidratos_disponibles',
        'total_ac_grasos_saturados',
        'total_ac_grasos_monoinsaturados',
        'total_ac_grasos_poliinsaturados',
        'total_fibra',
        'total_colesterol',
        'edit',
        'origin_recipe_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
