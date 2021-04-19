<?php

namespace App\Models;

use App\Models\Traits\Method\PlanMethod;
use App\Models\Traits\Relationship\PlanRelationship;


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
        'method',
        'weight',
        'height',
        'age',
        'activity',
        'tmb',
        'method_result',
        'duplicate',
        'origin_plan_id',
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
