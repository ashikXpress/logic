<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_appraisals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->integer('department_id')->nullable();
            $table->float('jan_jun_work_standards')->nullable();
            $table->float('jul_dec_work_standards')->nullable();
            $table->float('jan_jun_speed_consider')->nullable();
            $table->float('jul_dec_speed_consider')->nullable();
            $table->float('jan_jun_quality_of_work')->nullable();
            $table->float('jul_dec_quality_of_work')->nullable();
            $table->float('jan_jun_care_of_equipment')->nullable();
            $table->float('jul_dec_care_of_equipment')->nullable();
            $table->float('jan_jun_work_habits')->nullable();
            $table->float('jul_dec_work_habits')->nullable();
            $table->float('jan_jun_dependability')->nullable();
            $table->float('jul_dec_dependability')->nullable();
            $table->float('jan_jun_timekeeping')->nullable();
            $table->float('jul_dec_timekeeping')->nullable();
            $table->float('jan_jun_safety_consciousness')->nullable();
            $table->float('jul_dec_safety_consciousness')->nullable();
            $table->float('jan_jun_attitude')->nullable();
            $table->float('jul_dec_attitude')->nullable();
            $table->float('jan_jun_attitude_towards_supervision')->nullable();
            $table->float('jul_dec_attitude_towards_supervision')->nullable();
            $table->float('jan_jun_attitude_towards')->nullable();
            $table->float('jul_dec_attitude_towards')->nullable();
            $table->float('jan_jun_attitude_to_words_works')->nullable();
            $table->float('jul_dec_attitude_to_words_works')->nullable();
            $table->float('jan_jun_personal_behaviour')->nullable();
            $table->float('jul_dec_personal_behaviour')->nullable();
            $table->float('jan_jun_initiative_ability')->nullable();
            $table->float('jul_dec_initiative_ability')->nullable();
            $table->float('jan_jun_adaptability')->nullable();
            $table->float('jul_dec_adaptability')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_appraisals');
    }
}
