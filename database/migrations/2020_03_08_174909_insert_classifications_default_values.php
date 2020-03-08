<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertClassificationsDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert('insert into classifications(id,name) values (1,"Normal")');
        DB::insert('insert into classifications(id,name) values (2,"Vegetariano/a")');
        DB::insert('insert into classifications(id,name) values (3,"Vegano/a")');
        DB::insert('insert into classifications(id,name) values (4,"Sin TACC")');
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
