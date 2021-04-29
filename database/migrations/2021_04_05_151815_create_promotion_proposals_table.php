<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_proposals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->text('achievement_in_the_present_job');
            $table->text('additional_responsibilities_');
            $table->string('promotion_next_higher_position');
            $table->string('comments_of_immediate_supervisor');
            $table->string('comments_of_next_supervisor');
            $table->string('comments_of_concern_managers');
            $table->string('comments_of_division_head');
            $table->string('comments_of_executive_director');
            $table->string('acknowledgement_from_unit_hr');
            $table->string('comments_of_head_of_hr');
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
        Schema::dropIfExists('promotion_proposals');
    }
}
