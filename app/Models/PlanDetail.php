<?php

namespace App\Models;

use App\Models\Traits\Method\PlanDetailMethod;
use App\Models\Traits\Relationship\PlanDetailRelationship;

/**
 * App\Models\Recipe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read \App\Models\RecipeType $recipeType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property int $id
 * @property int $plan_id
 * @property int $recipe_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Plan $plan
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereUpdatedBy($value)
 */
class PlanDetail extends BaseModel
{
    use PlanDetailMethod,
        PlanDetailRelationship;

    public $table = 'plan_details';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'plan_id',
        'recipe_id',
        'day',
        'order',
        'order_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const tipo_desayuno = 1;
    const tipo_almuerzo = 2;
    const tipo_merienda = 3;
    const tipo_cena     = 4;
    const tipo_colacion = 5;
    const tipo_pre_entreno = 6;
    const tipo_post_entreno = 7;

    public static $types = [
        self::tipo_desayuno => 'Desayuno',
        self::tipo_almuerzo => 'Almuerzo',
        self::tipo_merienda => 'Merienda',
        self::tipo_cena     => 'Cena',
        self::tipo_colacion => 'Colación',
        self::tipo_pre_entreno => 'Pre Entreno',
        self::tipo_post_entreno => 'Post Entreno',
    ];
}
