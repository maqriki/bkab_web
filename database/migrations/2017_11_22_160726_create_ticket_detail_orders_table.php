<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketDetailOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_detail_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('lokasi_id')->nullable();
            $table->string('lokasi_nama')->nullable();
            $table->string('tiket_dewasa')->nullable();
            $table->string('tiket_anak')->nullable();
            $table->string('retrib_dewasa')->nullable();
            $table->string('retrib_anak')->nullable();
            $table->string('total_retrib')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('status_payment')->nullable();
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
        Schema::dropIfExists('ticket_detail_orders');
    }
}
