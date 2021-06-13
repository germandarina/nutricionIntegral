<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Session;

class ClientScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (\Schema::hasColumn($model->getTable(),'client_id'))
            return $builder->where('client_id', '=', Session::get('client_id'));
    }
}
