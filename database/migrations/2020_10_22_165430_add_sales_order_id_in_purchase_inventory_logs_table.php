<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalesOrderIdInPurchaseInventoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_inventory_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_order_id')->nullable()->after('purchase_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_inventory_logs', function (Blueprint $table) {
            $table->dropColumn('sales_order_id');
        });
    }
}
