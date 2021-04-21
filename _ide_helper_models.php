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
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BasicInformation
 *
 * @property int $id
 * @property string|null $full_name
 * @property string|null $address
 * @property string|null $email
 * @property string|null $m_professional
 * @property string|null $company_name
 * @property string|null $path_image
 * @property string|null $color_days
 * @property string|null $color_headers
 * @property string|null $color_observations
 * @property int $frequency_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property-read mixed $phones_front
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $imageRecommendations
 * @property-read int|null $image_recommendations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phone[] $phones
 * @property-read int|null $phones_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $recommendations
 * @property-read int|null $recommendations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $textRecommendations
 * @property-read int|null $text_recommendations_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereColorDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereColorHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereColorObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereFrequencyDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereMProfessional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation wherePathImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicInformation whereUpdatedBy($value)
 */
	class BasicInformation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classification
 *
 * @property int $id
 * @property string $name
 * @property int $default_register
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read int|null $patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 * @property-read int|null $recipes_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereDefaultRegister($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUpdatedBy($value)
 */
	class Classification extends \Eloquent {}
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
 * @property float $riboflavina
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereRiboflavina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereSodio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereTiamina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereVitaminaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Food whereZinc($value)
 * @property string|null $fibra
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property-read int|null $ingredients_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereFibra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereProteina($value)
 */
	class Food extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 */
	class FoodGroup extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 */
	class Ingredient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Observation
 *
 * @property int $id
 * @property string $name
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 * @property-read int|null $recipes_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Observation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Observation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Observation whereUpdatedBy($value)
 */
	class Observation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $document
 * @property \Illuminate\Support\Carbon $birthdate
 * @property int $age
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string $motive
 * @property int $number_of_children
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $gender
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read int|null $classifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FoodGroup[] $foodGroups
 * @property-read int|null $food_groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 * @property-read int|null $foods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plan[] $plans
 * @property-read int|null $plans_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMotive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereNumberOfChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedBy($value)
 */
	class Patient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Phone
 *
 * @property int $id
 * @property int $basic_information_id
 * @property string|null $code_area
 * @property string|null $phone
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereBasicInformationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereCodeArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereUpdatedBy($value)
 */
	class Phone extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Plan
 *
 * @property int $id
 * @property string $name
 * @property int $patient_id
 * @property int $days
 * @property float $energia_kcal_por_dia
 * @property float $proteina_por_dia
 * @property float $carbohidratos_por_dia
 * @property float $grasa_total_por_dia
 * @property int $open
 * @property int|null $method
 * @property string|null $weight
 * @property string|null $height
 * @property int|null $age
 * @property string|null $activity
 * @property string|null $tmb
 * @property string|null $method_result
 * @property int $duplicate
 * @property int|null $origin_plan_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlanDetail[] $details
 * @property-read int|null $details_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlanEnergySpending[] $energySpendings
 * @property-read int|null $energy_spendings_count
 * @property-read mixed $days_descriptions
 * @property-read mixed $status
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCarbohidratosPorDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDuplicate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereEnergiaKcalPorDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereGrasaTotalPorDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereMethodResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereOriginPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereProteinaPorDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereTmb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereWeight($value)
 */
	class Plan extends \Eloquent {}
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
 * @property int $portions
 * @property int $day
 * @property string|null $day_description
 * @property int $order
 * @property int|null $order_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Observation[] $observations
 * @property-read int|null $observations_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanDetail whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanDetail whereDayDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanDetail whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanDetail whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanDetail wherePortions($value)
 */
	class PlanDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlanEnergySpending
 *
 * @property int $id
 * @property int $plan_id
 * @property string $description
 * @property string $tmb
 * @property int $hours
 * @property int $days
 * @property string $weekly_average_activity
 * @property string $activity
 * @property string $factor_activity
 * @property string $total
 * @property string $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereFactorActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereTmb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanEnergySpending whereWeeklyAverageActivity($value)
 */
	class PlanEnergySpending extends \Eloquent {}
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
 * @property int $portions
 * @property string|null $total_energia_kcal
 * @property string|null $total_agua
 * @property string|null $total_proteina
 * @property string|null $total_grasa_total
 * @property string|null $total_carbohidratos_totales
 * @property string|null $total_cenizas
 * @property string|null $total_sodio
 * @property string|null $total_potasio
 * @property string|null $total_calcio
 * @property string|null $total_fosforo
 * @property string|null $total_hierro
 * @property string|null $total_zinc
 * @property string|null $total_tiamina
 * @property float|null $total_riboflavina
 * @property string|null $total_niacina
 * @property string|null $total_vitamina_c
 * @property string|null $total_carbohidratos_disponibles
 * @property string|null $total_ac_grasos_saturados
 * @property string|null $total_ac_grasos_monoinsaturados
 * @property string|null $total_ac_grasos_poliinsaturados
 * @property string|null $total_colesterol
 * @property string|null $total_fibra
 * @property int $edit
 * @property int|null $origin_recipe_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Observation[] $observations
 * @property-read int|null $observations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlanDetail[] $planDetails
 * @property-read int|null $plan_details_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereEdit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereOriginRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe wherePortions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalAcGrasosMonoinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalAcGrasosPoliinsaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalAcGrasosSaturados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalAgua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalCalcio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalCarbohidratosDisponibles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalCarbohidratosTotales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalCenizas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalColesterol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalEnergiaKcal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalFibra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalFosforo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalGrasaTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalHierro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalNiacina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalPotasio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalProteina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalRiboflavina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalSodio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalTiamina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalVitaminaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTotalZinc($value)
 */
	class Recipe extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 */
	class RecipeType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Recommendation
 *
 * @property int $id
 * @property int $basic_information_id
 * @property int $type
 * @property string $recommendation
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel fullText($term, $or = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereBasicInformationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRecommendation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereUpdatedBy($value)
 */
	class Recommendation extends \Eloquent {}
}

