<?php

namespace App\Models;


class Recommendation extends BaseModel
{
    public $table = 'basic_information_recommendations';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'basic_information_id',
        'type',
        'recommendation',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const type_text = 0;
    const type_img  = 1;

    public static $types = [
      self::type_text   => 'Texto',
      self::type_img    => 'Imagen',
    ];
}
