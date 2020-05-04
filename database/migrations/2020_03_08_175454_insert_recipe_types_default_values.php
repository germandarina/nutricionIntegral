<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertRecipeTypesDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert('insert into recipe_types(id,name) values (1,"Almuerzo")');
        DB::insert('insert into recipe_types(id,name) values (2,"Cena")');
        DB::insert('insert into recipe_types(id,name) values (3,"Desayuno")');
        DB::insert('insert into recipe_types(id,name) values (4,"Merienda")');
        DB::insert('insert into recipe_types(id,name) values (5,"Colación")');
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
