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
    const mifflin_st_jeor   = 3;

    public static $methods = [
        self::factorial_fao_homs => 'Factorial Fao / Oms',
        self::harris_benedict    => 'Harris / Benedict',
        self::mifflin_st_jeor    => 'Mifflin / St Jeor',
    ];

    const cama_o_reposo          = 1;
    const act_minima_manutencion = 1.4;
    const trabajo_ligero         = 1.7;
    const trabajo_moderado_masc  = 2.7;
    const trabajo_moderado_fem   = 2.2;
    const trabajo_pesado_masc    = 3.8;
    const trabajo_pesado_fem     = 2.8;
    const entrenamiento_cardio   = 6;
    const entrenamiento_pesas    = 5;
    const act_discrecionales     = 3;

    public static $activities = [
        self::cama_o_reposo             => 'Cama o Reposo',
        self::act_minima_manutencion    => 'Actividad Mínima Manutencion (AMM)',
        self::trabajo_ligero            => 'Trabajo Ligero (TL)',
        self::trabajo_moderado_masc     => 'Trabajo Moderado (Masc)',
        self::trabajo_moderado_fem      => 'Trabajo Moderado (Fem)',
        self::trabajo_pesado_masc       => 'Trabajo Pesado (Masc)',
        self::trabajo_pesado_fem        => 'Trabajo Pesado (Fem)',
        self::entrenamiento_cardio      => 'Entrenamiento Cardiovascular',
        self::entrenamiento_pesas       => 'Entrenamiento con Pesas',
        self::act_discrecionales        => 'Actividades Discrecionales',
    ];
}
