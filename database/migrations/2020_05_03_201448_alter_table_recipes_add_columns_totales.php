<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRecipesAddColumnsTotales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes',function (Blueprint $table){
            $table->decimal('total_energia_kcal',15,3)->default(0.00)->nullable();
            $table->decimal('total_agua',15,3)->default(0.00)->nullable();
            $table->decimal('total_proteina',15,3)->default(0.00)->nullable();
            $table->decimal('total_grasa_total',15,3)->default(0.00)->nullable();
            $table->decimal('total_carbohidratos_totales',15,3)->default(0.00)->nullable();
            $table->decimal('total_cenizas',15,3)->default(0.00)->nullable();
            $table->decimal('total_sodio',15,3)->default(0.00)->nullable();
            $table->decimal('total_potasio',15,3)->default(0.00)->nullable();
            $table->decimal('total_calcio',15,3)->default(0.00)->nullable();
            $table->decimal('total_fosforo',15,3)->default(0.00)->nullable();
            $table->decimal('total_hierro',15,3)->default(0.00)->nullable();
            $table->decimal('total_zinc',15,3)->default(0.00)->nullable();
            $table->decimal('total_tiamina',15,3)->default(0.00)->nullable();
            $table->decimal('total_rivoflavina',15,3)->default(0.00)->nullable();
            $table->decimal('total_niacina',15,3)->default(0.00)->nullable();
            $table->decimal('total_vitamina_c',15,3)->default(0.00)->nullable();
            $table->decimal('total_carbohidratos_disponibles',15,3)->default(0.00)->nullable();
            $table->decimal('total_ac_grasos_saturados',15,3)->default(0.00)->nullable();
            $table->decimal('total_ac_grasos_monoinsaturados',15,3)->default(0.00)->nullable();
            $table->decimal('total_ac_grasos_poliinsaturados',15,3)->default(0.00)->nullable();
            $table->decimal('total_colesterol',15,3)->default(0.00)->nullable();
            $table->decimal('total_fibra',15,3)->default(0.00)->nullable();

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
