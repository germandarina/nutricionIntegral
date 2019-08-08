<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;

/**
 * Class User.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read string $action_buttons
 * @property-read string $change_password_button
 * @property-read string $clear_session_button
 * @property-read string $confirmed_button
 * @property-read string $confirmed_label
 * @property-read string $delete_button
 * @property-read string $delete_permanently_button
 * @property-read string $edit_button
 * @property-read string $full_name
 * @property-read string $login_as_button
 * @property-read string $name
 * @property-read string $permissions_label
 * @property-read mixed $picture
 * @property-read string $restore_button
 * @property-read string $roles_label
 * @property-read string $show_button
 * @property-read string $social_buttons
 * @property-read string $status_button
 * @property-read string $status_label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\PasswordHistory[] $passwordHistories
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\SocialAccount[] $providers
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-write mixed $password
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User active($status = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User confirmed($confirmed = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser uuid($uuid)
 * @mixin \Eloquent
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;
}
