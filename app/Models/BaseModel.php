<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class BaseModel extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        // create a event to happen on deleting
        static::deleting(function ($table) {
            if (auth()->user()) {
                $table->deleted_by = auth()->user()->email;
            }else{
                $table->deleted_by = 'cron';
            }
            $table->save();
        });

        //this function not work when updating
        static::updating(function ($table) {
            if (auth()->user()) {
                $table->updated_by = auth()->user()->email;
            }else{
                $table->updated_by = 'cron';
            }
        });

        //this function work perfectly
        static::creating(function ($table) {
            if (auth()->user()) {
                $table->created_by = auth()->user()->email;
            }else{
                $table->created_by = 'cron';
            }

        });

    }
}
