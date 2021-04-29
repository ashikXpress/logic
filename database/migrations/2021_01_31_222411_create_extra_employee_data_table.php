<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraEmployeeDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_employee_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date_of_birth');
            $table->date('present_date');
            $table->string('age');
            $table->string('service');
            $table->date('resignation_date');
            $table->string('service_duration');
            $table->string('function_family');
            $table->string('work_place');
            $table->string('employee_group');
            $table->string('employee_subgroup');
            $table->string('employee_category');
            $table->string('position');
            $table->string('company');
            $table->string('gender');
            $table->string('highest_education');
            $table->string('highest_education_passing_year');
            $table->string('major_education');
            $table->string('major_education_passing_year');
            $table->string('blood_group');
            $table->string('nationality');
            $table->string('mother_name');
            $table->string('home_district');
            $table->string('permanent_address');
            $table->string('present_address');
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
        Schema::dropIfExists('extra_employee_data');
    }
}
