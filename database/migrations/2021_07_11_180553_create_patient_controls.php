<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientControls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Peso
            Talla
            Cintura
            Cadera
            Kg de músculo
            Kg de grasa
            %de músculo
            % de grasa
         */
        Schema::create('patient_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->date('period');
            $table->decimal('height',5,2)->default(0);
            $table->decimal('weight',5,2)->default(0);
            $table->decimal('waist',5,2)->default(0);
            $table->decimal('hips',5,2)->default(0);
            $table->decimal('muscle_kg',5,2)->default(0);
            $table->decimal('fat_kg',5,2)->default(0);
            $table->decimal('muscle_percent',5,2)->default(0);
            $table->decimal('fat_percent',5,2)->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_controls');
    }
}
