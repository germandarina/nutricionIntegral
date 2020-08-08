<?php

namespace App\Models;

use App\Models\Traits\Method\PlanDetailDayMethod;
use App\Models\Traits\Relationship\PlanDetailDayRelationship;
use Illuminate\Database\Eloquent\Model;

class PlanDetailDay extends BaseModel
{
    use PlanDetailDayMethod,
        PlanDetailDayRelationship;

    public $table = 'plan_details_days';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'plan_detail_id',
        'day',
        'plan_id',
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
