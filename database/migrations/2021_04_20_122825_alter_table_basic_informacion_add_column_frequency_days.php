<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBasicInformacionAddColumnFrequencyDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_information',function (Blueprint $table){
            $table->unsignedTinyInteger('frequency_days')->default(30)->after('color_observations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_information',function (Blueprint $table){
            $table->dropColumn('frequency_days');
        });
    }
}
