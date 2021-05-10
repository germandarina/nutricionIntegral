<?php

namespace App\Models;

class PlanEnergySpending extends BaseModel
{
    public $table = 'plan_energy_spending';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'plan_id',
        'description',
        'tmb',
        'hours',
        'new_hors',
        'days',
        'weekly_average_activity',
        'activity',
        'factor_activity',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const cama_o_reposo          = '1.00';
    const act_minima_manutencion = '1.40';
    const trabajo_ligero         = '1.70';
    const trabajo_moderado_masc  = '2.70';
    const trabajo_moderado_fem   = '2.20';
    const trabajo_pesado_masc    = '3.80';
    const trabajo_pesado_fem     = '2.80';
    const entrenamiento_cardio   = '6.00';
    const entrenamiento_pesas    = '5.00';
    const act_discrecionales     = '3.00';

    public static $activities_fao_oms = [
        self::cama_o_reposo             => 'Cama o Reposo - Valor: 1.00',
        self::act_minima_manutencion    => 'Actividad Mínima Manutencion (AMM) - Valor: 1.40',
        self::trabajo_ligero            => 'Trabajo Ligero (TL) - Valor: 1.70',
        self::trabajo_moderado_masc     => 'Trabajo Moderado (Masc) - Valor: 2.70',
        self::trabajo_moderado_fem      => 'Trabajo Moderado (Fem) - Valor: 2.20',
        self::trabajo_pesado_masc       => 'Trabajo Pesado (Masc) - Valor: 3.80',
        self::trabajo_pesado_fem        => 'Trabajo Pesado (Fem) - Valor: 2.80',
        self::entrenamiento_cardio      => 'Entrenamiento Cardiovascular - Valor: 6.00',
        self::entrenamiento_pesas       => 'Entrenamiento con Pesas - Valor: 5.00',
        self::act_discrecionales        => 'Actividades Discrecionales - Valor: 3.00',
    ];
}
