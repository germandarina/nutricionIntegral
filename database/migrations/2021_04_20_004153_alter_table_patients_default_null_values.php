<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePatientsDefaultNullValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients',function (Blueprint $table){
            $table->string('document')->nullable()->default(null)->change();
            $table->string('address')->nullable()->default(null)->change();
            $table->string('phone')->nullable()->default(null)->change();
            $table->string('email')->nullable()->default(null)->change();
            $table->integer('number_of_children')->default(0)->change();
        });
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
