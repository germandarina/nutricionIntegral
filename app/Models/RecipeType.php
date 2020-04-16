<?php

namespace App\Models;

use App\Models\Traits\Method\RecipeTypeMethod;
use App\Models\Traits\Relationship\RecipeTypeRelationship;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\RecipeType
 *
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 * @property int $id
 * @property string $name
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $recipes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType whereUpdatedBy($value)
 */
class RecipeType extends BaseModel
{
    use RecipeTypeMethod,
        RecipeTypeRelationship;

    public $table = 'recipe_types';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
