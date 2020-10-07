<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlanDetailsAddColumnRecipeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_details',function (Blueprint  $table){
            $table->unsignedTinyInteger('order_type')->nullable()->default(null)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_details',function (Blueprint  $table){
            $table->dropColumn('order_type');
        });
    }
}
