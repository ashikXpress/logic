<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->string('title');
            $table->string('institute');
            $table->string('department');
            $table->string('passing_year');
            $table->string('result');
            $table->string('out_off_result');
            $table->string('duration');
            $table->string('academic_certificate');
            $table->string('training_title');
            $table->string('training_institute');
            $table->string('training_certificate');
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
        Schema::dropIfExists('academic_trainings');
    }
}
