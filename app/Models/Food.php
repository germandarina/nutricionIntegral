<?php

namespace App\Models;

use App\Models\Traits\Method\FoodMethod;
use App\Models\Traits\Relationship\FoodRelationship;

/**
 * App\Models\Food
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read \App\Models\FoodGroup $foodGroup
 * @property int $id
 * @property string $name
 * @property int $food_group_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property float $energia_kj
 * @property float $energia_kcal
 * @property float $agua
 * @property float $proteina
 * @property float $grasa_total
 * @property float $carbohidratos_totales
 * @property float $cenizas
 * @property float $sodio
 * @property float $potasio
 * @property float $calcio
 * @property float $fosforo
 * @property float $hierro
 * @property float $zinc
 * @property float $tiamina
 * @property float $riboflavina
 * @property float $niacina
 * @property float $vitamina_c
 * @property float $carbohidratos_disponibles
 * @property float $ac_grasos_saturados
 * @property float $ac_grasos_monoinsaturados
 * @property float $ac_grasos_poliinsaturados
 * @property float $colesterol
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAcGrasosMonoinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAcGrasosPoliinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAcGrasosSaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAgua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCalcio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCarbohidratosDisponibles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCarbohidratosTotales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCenizas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereColesterol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereEnergiaKcal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereEnergiaKj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereFoodGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereFosforo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereGrasaTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereHierro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereNiacina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food wherePotasio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereProtenia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereRiboflavina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereSodio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereTiamina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereVitaminaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereZinc($value)
 */
class Food extends BaseModel
{
    use FoodMethod,
        FoodRelationship;

    public $table = 'foods';
    protected $columns_full_text  = ['name'];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'food_group_id',
        'energia_kcal',
        'agua',
        'proteina',
        'grasa_total',
        'carbohidratos_totales',
        'cenizas',
        'sodio',
        'potasio',
        'calcio',
        'fosforo',
        'hierro',
        'zinc',
        'tiamina',
        'riboflavina',
        'niacina',
        'vitamina_c',
        'carbohidratos_disponibles',
        'ac_grasos_saturados',
        'ac_grasos_monoinsaturados',
        'ac_grasos_poliinsaturados',
        'fibra',
        'colesterol',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
