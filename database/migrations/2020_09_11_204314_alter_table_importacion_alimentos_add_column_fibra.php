<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImportacionAlimentosAddColumnFibra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('importacion_alimentos',function (Blueprint $table){
           $table->string('fibra')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('importacion_alimentos',function (Blueprint $table){
            $table->dropColumn('fibra');
        });
    }
}
