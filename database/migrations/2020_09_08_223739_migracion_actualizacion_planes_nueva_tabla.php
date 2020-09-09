<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\PlanDetailDay;
use App\Models\PlanDetail;
class MigracionActualizacionPlanesNuevaTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
            $plan_detail_days = PlanDetailDay::all();
            foreach ($plan_detail_days as $plan_detail_day){
                $plan_details = PlanDetail::where('id',$plan_detail_day->plan_detail_id)->get();
                foreach ($plan_details as $plan_detail){
                    if($plan_detail->day == 0 && $plan_detail_day->day != 0){
                        $plan_detail->day   = $plan_detail_day->day;
                        $plan_detail->order = $plan_detail_day->order;
                        $plan_detail->save();
                        break;
                    }
                }
            }
        DB::commit();

        Schema::dropIfExists('plan_details_days');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
