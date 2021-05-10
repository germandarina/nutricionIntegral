<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlanSpendingEnergyChangeHoursFieldToDouble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_energy_spending', function (Blueprint $table) {
            $table->decimal('new_hours',10,2)->after('hours');
        });

        $plan_spending = \App\Models\PlanEnergySpending::all();
        foreach ($plan_spending as $spending)
        {
            $spending->new_hours = $spending->hours;
            $spending->save();
        }

        Schema::table('plan_energy_spending', function (Blueprint $table) {
            $table->dropColumn('hours');
            $table->renameColumn('new_hours','hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_energy_spending', function (Blueprint $table) {
            $table->dropColumn('new_hours');
        });
    }
}
