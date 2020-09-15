<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertFoodGroupsFromSara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert('insert into food_groups(name) values ("Bebidas")');
        DB::insert('insert into food_groups(name) values ("Alimentos Pre-elaborados")');
        DB::insert('insert into food_groups(name) values ("Aderezos y sopas")');
        DB::insert('insert into food_groups(name) values ("Suplementos")');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sara', function (Blueprint $table) {
            //
        });
    }
}
