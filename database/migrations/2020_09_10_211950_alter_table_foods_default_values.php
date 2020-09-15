<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFoodsDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods',function (Blueprint $table){
            $table->decimal('energia_kcal',15,3)->default(0)->change();
            $table->decimal('agua',15,3)->default(0)->change();
            $table->decimal('proteina',15,3)->default(0)->change();
            $table->decimal('grasa_total',15,3)->default(0)->change();
            $table->decimal('carbohidratos_totales',15,3)->default(0)->change();
            $table->decimal('cenizas',15,3)->default(0)->change();
            $table->decimal('sodio',15,3)->default(0)->change();
            $table->decimal('potasio',15,3)->default(0)->change();
            $table->decimal('calcio',15,3)->default(0)->change();
            $table->decimal('fosforo',15,3)->default(0)->change();
            $table->decimal('hierro',15,3)->default(0)->change();
            $table->decimal('zinc',15,3)->default(0)->change();
            $table->decimal('tiamina',15,3)->default(0)->change();
            $table->decimal('rivoflavina',15,3)->default(0)->change();
            $table->decimal('niacina',15,3)->default(0)->change();
            $table->decimal('vitamina_c',15,3)->default(0)->change();
            $table->decimal('carbohidratos_disponibles',15,3)->default(0)->change();
            $table->decimal('ac_grasos_saturados',15,3)->default(0)->change();
            $table->decimal('ac_grasos_monoinsaturados',15,3)->default(0)->change();
            $table->decimal('ac_grasos_poliinsaturados',15,3)->default(0)->change();
            $table->decimal('colesterol',15,3)->default(0)->change();
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
