<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePfLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pf_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loan_given_employee_id');
            $table->double('amount',20,2);
            $table->float('interest');
            $table->double('payble_amount',20,2);
            $table->double('paid',20,2);
            $table->double('due',20,2);
            $table->date('pf_loan_date');
            $table->text('note');
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
        Schema::dropIfExists('pf_loans');
    }
}
