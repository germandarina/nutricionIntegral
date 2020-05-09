<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


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
	class User extends \Eloquent {}
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
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string|null $token
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereUserId($value)
 */
	class SocialAccount extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class PasswordHistory.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereUserId($value)
 */
	class PasswordHistory extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class User.
 *
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
 * @property-read int|null $notifications_count
 * @property-read int|null $permissions_count
 * @property-read int|null $roles_count
 */
	class BaseUser extends \Eloquent {}
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
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Recipe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read \App\Models\RecipeType $recipeType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property int $id
 * @property int $plan_id
 * @property int $recipe_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Plan $plan
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 */
	class PlanDetail extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 */
	class Classification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Plan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read \App\Models\RecipeType $recipeType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property int $id
 * @property string $name
 * @property int $patient_id
 * @property int $days
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $classifications_count
 * @property-read int|null $ingredients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlanDetail[] $details
 * @property-read int|null $details_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 */
	class Plan extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property int $id
 * @property string $name
 * @property int $recipe_type_id
 * @property string $observation
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $classifications_count
 * @property-read int|null $ingredients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereRecipeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereUpdatedBy($value)
 * @property float|null $total_energia_kcal
 * @property float|null $total_agua
 * @property float|null $total_proteina
 * @property float|null $total_grasa_total
 * @property float|null $total_carbohidratos_totales
 * @property float|null $total_cenizas
 * @property float|null $total_sodio
 * @property float|null $total_potasio
 * @property float|null $total_calcio
 * @property float|null $total_fosforo
 * @property float|null $total_hierro
 * @property float|null $total_zinc
 * @property float|null $total_tiamina
 * @property float|null $total_rivoflavina
 * @property float|null $total_niacina
 * @property float|null $total_vitamina_c
 * @property float|null $total_carbohidratos_disponibles
 * @property float|null $total_ac_grasos_saturados
 * @property float|null $total_ac_grasos_monoinsaturados
 * @property float|null $total_ac_grasos_poliinsaturados
 * @property float|null $total_colesterol
 * @property float|null $total_fibra
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalAcGrasosMonoinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalAcGrasosPoliinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalAcGrasosSaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalAgua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalCalcio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalCarbohidratosDisponibles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalCarbohidratosTotales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalCenizas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalColesterol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalEnergiaKcal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalFibra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalFosforo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalGrasaTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalHierro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalNiacina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalPotasio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalProteina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalRivoflavina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalSodio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalTiamina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalVitaminaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereTotalZinc($value)
 */
	class Recipe extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 */
	class Patient extends \Eloquent {}
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
 * @property-read \App\Models\FoodGroup $foodGroup
 * @property int $id
 * @property string $name
 * @property int $food_group_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property float $energia_kj
 * @property float $energia_kcal
 * @property float $agua
 * @property float $proteina
 * @property float $grasa_total
 * @property float $carbohidratos_totales
 * @property float $cenizas
 * @property float $sodio
 * @property float $potasio
 * @property float $calcio
 * @property float $fosforo
 * @property float $hierro
 * @property float $zinc
 * @property float $tiamina
 * @property float $rivoflavina
 * @property float $niacina
 * @property float $vitamina_c
 * @property float $carbohidratos_disponibles
 * @property float $ac_grasos_saturados
 * @property float $ac_grasos_monoinsaturados
 * @property float $ac_grasos_poliinsaturados
 * @property float $colesterol
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAcGrasosMonoinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAcGrasosPoliinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAcGrasosSaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereAgua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCalcio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCarbohidratosDisponibles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCarbohidratosTotales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCenizas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereColesterol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereEnergiaKcal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereEnergiaKj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereFoodGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereFosforo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereGrasaTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereHierro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereNiacina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food wherePotasio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereProtenia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereRivoflavina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereSodio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereTiamina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereVitaminaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereZinc($value)
 * @property float|null $fibra
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereFibra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereProteina($value)
 */
	class Food extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ingredient
 *
 * @property-read \App\Models\Ingredient $ingredient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient query()
 * @mixin \Eloquent
 * @property-read \App\Models\Food $food
 * @property-read \App\Models\Recipe $recipe
 * @property int $id
 * @property int $recipe_id
 * @property int $food_id
 * @property string $quantity_description
 * @property float|null $quantity_grs
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereQuantityDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereQuantityGrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 */
	class Ingredient extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 */
	class RecipeType extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 * @property int $id
 * @property string $name
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $foods_count
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FoodGroup whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel fullText($term, $or = false)
 */
	class FoodGroup extends \Eloquent {}
}

