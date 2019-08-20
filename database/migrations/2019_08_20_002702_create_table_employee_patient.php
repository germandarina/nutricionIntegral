<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmployeePatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_patient', function (Blueprint $table) {
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_patient');
    }
}
