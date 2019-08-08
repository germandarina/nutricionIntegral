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
 */
class Role extends SpatieRole implements AuditableContract
{
    use Auditable,
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
