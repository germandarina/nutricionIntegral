<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlanDetailsAddColumnsDayAndOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_details',function (Blueprint $table){
            $table->unsignedTinyInteger('day')->after('recipe_id');
            $table->unsignedTinyInteger('order')->default(0)->after('day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_details',function (Blueprint $table){
            $table->dropColumn('day');
            $table->dropColumn('order');
        });
    }
}
