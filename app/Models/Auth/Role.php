<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use App\Models\Auth\Traits\Method\RoleMethod;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Models\Auth\Traits\Attribute\RoleAttribute;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Role.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read string $action_buttons
 * @property-read string $confirmed_button
 * @property-read string $delete_button
 * @property-read string $delete_permanently_button
 * @property-read string $edit_button
 * @property-read string $restore_button
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Auth\Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Auth\Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Auth\Role withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property-read int|null $permissions_count
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereUpdatedBy($value)
 */
class Role extends SpatieRole //implements AuditableContract
{
    use //Auditable,
        RoleAttribute,
        RoleMethod,
        SoftDeletes;

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'id',
    ];
}
