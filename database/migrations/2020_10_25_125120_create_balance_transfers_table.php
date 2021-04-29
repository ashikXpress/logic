<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->comment('1=Bank To Cash; 2=Cash To Bank; 3=Bank To Bank');
            $table->unsignedInteger('source_bank_id')->nullable();
            $table->unsignedInteger('source_branch_id')->nullable();
            $table->unsignedInteger('source_bank_account_id')->nullable();
            $table->string('source_cheque_no')->nullable();
            $table->string('source_cheque_image')->nullable();
            $table->unsignedInteger('target_bank_id')->nullable();
            $table->unsignedInteger('target_branch_id')->nullable();
            $table->unsignedInteger('target_bank_account_id')->nullable();
            $table->string('target_cheque_no')->nullable();
            $table->string('target_cheque_image')->nullable();
            $table->float('amount', 20);
            $table->date('date');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('balance_transfers');
    }
}
