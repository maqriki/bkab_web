<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticketing_id');
            $table->string('id_lokasi')->nullable();
            $table->string('nama_lokasi')->nullable();
            $table->string('ticket_dewasa')->nullable();
            $table->string('total_retrib_dewasa')->nullable();
            $table->string('ticket_anak')->nullable();
            $table->string('total_retrib_anak')->nullable();
            $table->string('total_ticket')->nullable();
            $table->string('total_retrib_pengunjung')->nullable();
            $table->string('total_bus_besar')->nullable();
            $table->string('total_retrib_bus_besar')->nullable();
            $table->string('total_bus')->nullable();
            $table->string('total_retrib_bus')->nullable();
            $table->string('total_mobil')->nullable();
            $table->string('total_retrib_mobil')->nullable();
            $table->string('total_motor')->nullable();
            $table->string('total_retrib_motor')->nullable();
            $table->string('total_kendaraan')->nullable();
            $table->string('total_retrib_kendaraan')->nullable();
            $table->string('total_retrib')->nullable();
            $table->string('operator')->nullable();
            $table->string('status_ticketing')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
