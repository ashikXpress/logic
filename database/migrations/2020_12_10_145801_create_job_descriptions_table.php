<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('candidate_interview_evalution_id');
            $table->string('section');
            $table->string('reporting_to');
            $table->string('immediate_subordinate_staff');
            $table->string('other_internal_contacts');
            $table->string('external_contacts');
            $table->string('duties_and_responsibilities');
            $table->string('work_hours');
            $table->string('work_condition');
            $table->string('travel');
            $table->string('financial_authority');
            $table->string('personal_decision_making_authority');
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
        Schema::dropIfExists('job_descriptions');
    }
}
