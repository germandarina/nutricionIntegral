<?php

namespace App\Models;

use App\Models\Traits\Method\FoodMethod;
use App\Models\Traits\Relationship\FoodRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Food
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 */
class Food extends BaseModel
{
    use FoodMethod,
        FoodRelationship;

    public $table = 'foods';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'food_group_id',
        'energia_kj',
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
        'rivoflavina',
        'niacina',
        'vitamina_c',
        'carbohidratos_disponibles',
        'ac_grasos_saturados',
        'ac_grasos_monoinsaturados',
        'ac_grasos_poliinsaturados',
        'colesterol',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
