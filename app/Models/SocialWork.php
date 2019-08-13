<?php

namespace App\Models;

use App\Models\Traits\Method\SocialWorkMethod;
use App\Models\Traits\Relationship\SocialWorkRelationship;

/**
 * App\Models\SocialWork
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialWork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialWork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialWork query()
 * @mixin \Eloquent
 */

class SocialWork extends BaseModel
{
    use SocialWorkMethod,
        SocialWorkRelationship;

    public $table = 'social_works';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
