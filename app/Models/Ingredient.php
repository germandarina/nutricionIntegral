<?php

namespace App\Models;

use App\Models\Traits\Method\IngredientMethod;
use App\Models\Traits\Relationship\IngredientRelationship;

class Ingredient extends BaseModel
{
    use IngredientMethod,
        IngredientRelationship;

    public $table = 'ingredients';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'recipe_id',
        'food_id',
        'quantity_description',
        'quantity_grs',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
