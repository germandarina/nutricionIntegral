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
        DB::insert('insert into recipe_types(id,name) values (1,"Desayuno/Merienda")');
        DB::insert('insert into recipe_types(id,name) values (2,"Almuerzo/Cena")');
        DB::insert('insert into recipe_types(id,name) values (3,"Colacion")');
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
