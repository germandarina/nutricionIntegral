<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\RecipeType
 *
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecipeType query()
 */
	class RecipeType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SocialWork
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialWork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialWork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialWork query()
 * @mixin \Eloquent
 */
	class SocialWork extends \Eloquent {}
}

namespace App\Models\Auth{
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
	class Role extends \Eloquent {}
}

namespace App\Models\Auth{
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
	class User extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class PasswordHistory.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory query()
 * @mixin \Eloquent
 */
	class PasswordHistory extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class SocialAccount.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount query()
 * @mixin \Eloquent
 */
	class SocialAccount extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class User.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Auth\BaseUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser uuid($uuid)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Auth\BaseUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Auth\BaseUser withoutTrashed()
 * @mixin \Eloquent
 */
	class BaseUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withoutTrashed()
 * @mixin \Eloquent
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FoodGroup[] $foodGroups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 */
	class Patient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classification
 *
 * @property-read \App\Models\Patient $patients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification query()
 */
	class Classification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Recipe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read \App\Models\RecipeType $recipeType
 */
	class Recipe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FoodGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 */
	class FoodGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Food
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 */
	class Food extends \Eloquent {}
}

