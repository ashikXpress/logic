<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkrpLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skrp_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->double('amount',20,2);
            $table->float('interest');
            $table->tinyInteger('installment_month');
            $table->double('per_month_payble_amount',20,2);
            $table->double('total_payble_amount',20,2);
            $table->double('paid',20,2);
            $table->double('due',20,2);
            $table->date('skrp_loan_date');
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
        Schema::dropIfExists('skrp_loans');
    }
}
