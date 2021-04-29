<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no');
            $table->unsignedBigInteger('sister_concern_id');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->date('date');
            $table->float('sub_total', 20);
            $table->float('vat_percentage');
            $table->float('vat', 20);
            $table->float('discount', 20);
            $table->float('total', 20);
            $table->float('paid', 20);
            $table->float('due', 20);
            $table->date('next_payment')->nullable();
            $table->unsignedInteger('created_by')->nullable();
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
        Schema::dropIfExists('sales_orders');
    }
}
