<?php

namespace App\Models;

use App\Models\Traits\Method\PlanMethod;
use App\Models\Traits\Relationship\PlanRelationship;

/**
 * App\Models\Plan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read \App\Models\RecipeType $recipeType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property int $id
 * @property string $name
 * @property int $patient_id
 * @property int $days
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $classifications_count
 * @property-read int|null $ingredients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedBy($value)
 */
class Plan extends BaseModel
{
    use PlanMethod,
        PlanRelationship;

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
        'energia_kcal_por_dia',
        'carbohidratos_por_dia',
        'grasa_total_por_dia',
        'proteina_por_dia',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const factorial_fao_homs = 1;
    const harris_benedict    = 2;
    const mifflin_st_jeor    = 3;

    public static $methods = [
        self::factorial_fao_homs => 'Factorial Fao / Oms',
        self::harris_benedict    => 'Harris Benedict',
        self::mifflin_st_jeor    => 'Mifflin / St Jeor',
    ];

    const ligera_masc   = '1.60';
    const moderada_masc = '1.78';
    const alta_masc     = '2.10';
    const ligera_fem    = '1.50';
    const moderada_fem  = '1.64';
    const alta_fem      = '1.90';

    public static $activities = [
        self::ligera_masc   => 'Ligera (Masc) - Valor: 1.60',
        self::moderada_masc => 'Moderada (Masc) - Valor: 1.78',
        self::alta_masc     => 'Alta (Masc) - Valor: 2.10',
        self::ligera_fem    => 'Ligera (Fem) - Valor: 1.50',
        self::moderada_fem  => 'Moderada (Fem) - Valor: 1.64',
        self::alta_fem      => 'Alta (Fem) - Valor: 1.90',
    ];
}
