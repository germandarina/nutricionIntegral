<?php

namespace App\Models;

use App\Models\Traits\Method\RecommendationMethod;
use App\Models\Traits\Relationship\RecommendationRelationship;

class Recommendation extends BaseModel
{
    use RecommendationRelationship,
        RecommendationMethod;

    public $table = 'basic_information_recommendations';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'basic_information_id',
        'type',
        'origin',
        'recommendation',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const origin_general = 0;
    const origin_patient = 1;

    const type_text = 0;
    const type_img  = 1;

    public static $types = [
      self::type_text   => 'Texto',
      self::type_img    => 'Imagen',
    ];

    public static $origins = [
        self::origin_general => 'Recomendación General',
        self::origin_patient => 'Especifica para pacientes',
    ];
}
