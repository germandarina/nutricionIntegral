<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicInformationPersonalRecommendations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_information_recommendations', function (Blueprint $table) {
            $table->boolean('origin')->default(false)->after('basic_information_id');
        });

        Schema::create('basic_information_recommendation_patient',function (Blueprint $table){
            $table->unsignedBigInteger('recommendation_id');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('recommendation_id','foreign_recommendation')->references('id')->on('basic_information_recommendations')->onDelete('cascade');
            $table->foreign('patient_id','foreign_patient')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_information_recommendations', function (Blueprint $table) {
            $table->dropColumn('origin');
        });

        Schema::dropIfExists('basic_information_recommendation_patient');
    }
}
