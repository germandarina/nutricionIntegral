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
 * @property int $id
 * @property string $name
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $patients_count
 * @property-read int|null $recipes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereUpdatedBy($value)
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
