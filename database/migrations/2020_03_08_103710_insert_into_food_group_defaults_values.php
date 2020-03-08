<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertIntoFoodGroupDefaultsValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert('insert into food_groups(id,name) values(1,"Carnes")');
        DB::insert('insert into food_groups(id,name) values(2,"Cereales")');
        DB::insert('insert into food_groups(id,name) values(3,"Frutas")');
        DB::insert('insert into food_groups(id,name) values(4,"Grasas")');
        DB::insert('insert into food_groups(id,name) values(5,"Huevo")');
        DB::insert('insert into food_groups(id,name) values(6,"Lacteos")');
        DB::insert('insert into food_groups(id,name) values(7,"Pescados")');
        DB::insert('insert into food_groups(id,name) values(8,"Prod Azucarados")');
        DB::insert('insert into food_groups(id,name) values(9,"Vegetales")');
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
