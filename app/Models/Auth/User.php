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
 * @property int $id
 * @property string $uuid
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $avatar_type
 * @property string|null $avatar_location
 * @property \Illuminate\Support\Carbon|null $password_changed_at
 * @property bool $active
 * @property string|null $confirmation_code
 * @property bool $confirmed
 * @property string|null $timezone
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $last_login_ip
 * @property bool $to_be_logged_out
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $notifications_count
 * @property-read int|null $password_histories_count
 * @property-read int|null $permissions_count
 * @property-read int|null $providers_count
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereAvatarLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereAvatarType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereConfirmationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User wherePasswordChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereToBeLoggedOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereUuid($value)
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;
}
