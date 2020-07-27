<?php

namespace App\Models;

use App\Models\Traits\Method\PatientMethod;
use App\Models\Traits\Relationship\PatientRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FoodGroup[] $foodGroups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plan[] $plans
 * @property int $id
 * @property string $full_name
 * @property string $document
 * @property string $birthdate
 * @property int $age
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $motive
 * @property int $number_of_children
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read int|null $classifications_count
 * @property-read int|null $food_groups_count
 * @property-read int|null $foods_count
 * @property-read int|null $plans_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereMotive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereNumberOfChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereUpdatedBy($value)
 */
class Patient extends BaseModel
{
    use PatientMethod,
        PatientRelationship;

    public $table = 'patients';
    protected $columns_full_text  = ['full_name','document'];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'birthdate',
    ];

    protected $fillable = [
        'full_name',
        'birthdate',
        'age',
        'document',
        'address',
        'phone',
        'email',
        'motive',
        'number_of_children',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
