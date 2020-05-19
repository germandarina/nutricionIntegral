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

    /**
     * Columnas a utilizar con un índice de full text search
     *
     * @var array
     */
    protected $columns_full_text = [];

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
        static::updated(function ($table) {
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

    public function scopeFullText($query, $term, $or = false)
    {
        // armar array si es mas de una columna implode(',' , ['campo1', 'campo2', '...'])

        $columns = implode(',' , $this->columns_full_text);

        $match = "MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)";

        $pattern = $this->fullTextWildcards($term);

        if ($or)
            $query->orWhereRaw($match , $pattern);
        else
            $query->whereRaw($match, $pattern);

        return $query;
    }

    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if(strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode( ' ', $words);

        return [$searchTerm];
    }
}
