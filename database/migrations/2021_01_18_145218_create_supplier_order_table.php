<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->string('delivered_date');
            $table->bigInteger('payment_option_id')->unsigned();
            $table->foreign('payment_option_id')->references('id')->on('payment_option');
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
        Schema::dropIfExists('supplier_order');
    }
}
