<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFoodAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods',function (Blueprint $table){
            $table->decimal('energia_kj',15,3)->default(0.00);
            $table->decimal('energia_kcal',15,3)->default(0.00);
            $table->decimal('agua',15,3)->default(0.00);
            $table->decimal('protenia',15,3)->default(0.00);
            $table->decimal('grasa_total',15,3)->default(0.00);
            $table->decimal('carbohidratos_totales',15,3)->default(0.00);
            $table->decimal('cenizas',15,3)->default(0.00);
            $table->decimal('sodio',15,3)->default(0.00);
            $table->decimal('potasio',15,3)->default(0.00);
            $table->decimal('calcio',15,3)->default(0.00);
            $table->decimal('fosforo',15,3)->default(0.00);
            $table->decimal('hierro',15,3)->default(0.00);
            $table->decimal('zinc',15,3)->default(0.00);
            $table->decimal('tiamina',15,3)->default(0.00);
            $table->decimal('rivoflavina',15,3)->default(0.00);
            $table->decimal('niacina',15,3)->default(0.00);
            $table->decimal('vitamina_c',15,3)->default(0.00);
            $table->decimal('carbohidratos_disponibles',15,3)->default(0.00);
            $table->decimal('ac_grasos_saturados',15,3)->default(0.00);
            $table->decimal('ac_grasos_monoinsaturados',15,3)->default(0.00);
            $table->decimal('ac_grasos_poliinsaturados',15,3)->default(0.00);
            $table->decimal('colesterol',15,3)->default(0.00);
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
