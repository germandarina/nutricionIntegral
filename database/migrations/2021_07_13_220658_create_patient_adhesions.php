<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientAdhesions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_adhesions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('patient_control_id');
            $table->decimal('adhesion',5,2);
            $table->unsignedTinyInteger('real_hungry');
            $table->unsignedTinyInteger('emotional_hungry');
            $table->decimal('training_adhesion',5,2);
            $table->unsignedTinyInteger('training_performance');
            $table->unsignedTinyInteger('dream');
            $table->unsignedTinyInteger('stress');
            $table->unsignedTinyInteger('organization');
            $table->unsignedTinyInteger('alcohol');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('patient_control_id')->references('id')->on('patient_controls')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_adhesions');
    }
}
