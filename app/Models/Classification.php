<?php

namespace App\Models;

use App\Models\Traits\Method\ClassificationMethod;
use App\Models\Traits\Relationship\ClassificationRelationship;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Classification
 *
 * @property-read \App\Models\Patient $patients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification query()
 * @mixin \Eloquent
 */
class Classification extends BaseModel
{
    use ClassificationMethod,
        ClassificationRelationship;

    public $table = 'classifications';

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
