<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProductsAddColumnCalorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods',function (Blueprint $table){
           $table->decimal('calorias',15,3)->default(0);
        });

        Schema::table('recipes',function (Blueprint $table){
            $table->decimal('total_calorias',15,3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foods',function (Blueprint $table){
            $table->dropColumn('calorias');
        });

        Schema::table('recipes',function (Blueprint $table){
            $table->dropColumn('total_calorias');
        });
    }
}
