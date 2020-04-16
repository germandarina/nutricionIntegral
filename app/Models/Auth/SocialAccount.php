<?php

namespace App\Models\Auth;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

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
class SocialAccount extends Model //implements AuditableContract
{
//    use Auditable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'token',
        'avatar',
    ];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'id',
        'token',
    ];
}
