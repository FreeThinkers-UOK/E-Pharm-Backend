<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuarantineWastageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quarantine_wastage', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_details_id')->unsigned();
            $table->foreign('order_details_id')->references('id')->on('order_details');
            $table->string('created_by');
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
        Schema::dropIfExists('quarantine_wastage');
    }
}
