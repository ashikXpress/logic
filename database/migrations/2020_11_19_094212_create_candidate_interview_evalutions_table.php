<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateInterviewEvalutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_interview_evalutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile_no');
            $table->date('interview_date');
            $table->double('expected_salary',20,2);
            $table->double('current_salary',20,2)->nullable();
            $table->tinyInteger('dress_up')->default(0);
            $table->text('dress_up_remarks')->nullable();
            $table->tinyInteger('grooming_up')->default(0);
            $table->text('grooming_up_remarks')->nullable();
            $table->tinyInteger('body_language')->default(0);
            $table->text('body_language_remarks')->nullable();
            $table->tinyInteger('attitude')->default(0);
            $table->text('attitude_remarks')->nullable();
            $table->tinyInteger('personality')->default(0);
            $table->text('personality_remarks')->nullable();
            $table->tinyInteger('cv_status')->default(0);
            $table->text('cv_status_remarks')->nullable();
            $table->tinyInteger('educational_qualification')->default(0);
            $table->text('educational_qualification_remarks')->nullable();
            $table->tinyInteger('professional_qualification')->default(0);
            $table->text('professional_qualification_remarks')->nullable();
            $table->tinyInteger('training_and_others')->default(0);
            $table->text('training_and_others_remarks')->nullable();
            $table->tinyInteger('award_recogntion')->default(0);
            $table->text('award_recogntion_remarks')->nullable();
            $table->tinyInteger('relevent_experience')->default(0);
            $table->text('relevent_experience_remarks')->nullable();
            $table->tinyInteger('professional_achievements')->default(0);
            $table->text('professional_achievements_remarks')->nullable();
            $table->tinyInteger('potentiality')->default(0);
            $table->text('potentiality_remarks')->nullable();
            $table->tinyInteger('oral_communication')->default(0);
            $table->text('oral_communication_remarks')->nullable();
            $table->tinyInteger('eye_contact')->default(0);
            $table->text('eye_contact_remarks')->nullable();
            $table->tinyInteger('language_proficiency')->default(0);
            $table->text('language_proficiency_remarks')->nullable();
            $table->tinyInteger('computer_skill')->default(0);
            $table->text('computer_skill_remarks')->nullable();
            $table->tinyInteger('interpersonal_skill')->default(0);
            $table->text('interpersonal_skill_remarks')->nullable();
            $table->tinyInteger('job_knowledge')->default(0);
            $table->text('job_knowledge_remarks')->nullable();
            $table->tinyInteger('general_knowledge')->default(0);
            $table->text('general_knowledge_remarks')->nullable();
            $table->tinyInteger('family_background')->default(0);
            $table->text('family_background_remarks')->nullable();
            $table->tinyInteger('wllingness_to_learn')->default(0);
            $table->text('wllingness_to_learn_remarks')->nullable();
            $table->tinyInteger('long_term_objectives')->default(0);
            $table->text('long_term_objectives_remarks')->nullable();
            $table->tinyInteger('team_skill')->default(0);
            $table->text('team_skill_remarks')->nullable();
            $table->tinyInteger('working_planing_skill')->default(0);
            $table->text('working_planing_skill_remarks')->nullable();
            $table->tinyInteger('selected');
            $table->tinyInteger('short_Listed');
            $table->tinyInteger('may_be_Call_later');
            $table->tinyInteger('rejected');
            $table->double('salary_offer',20,2);
            $table->text('others_benefits');
            $table->text('any_condition');
            $table->date('expected_date_joining');
            $table->string('required_company_unit');
            $table->text('job_description');
            $table->boolean('status');
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
        Schema::dropIfExists('candidate_interview_evalutions');
    }
}
