<?php

namespace App\Models;

use App\Models\Traits\Method\PlanDetailMethod;
use App\Models\Traits\Relationship\PlanDetailRelationship;

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
        'portions',
        'day',
        'day_description',
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
