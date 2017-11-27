<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketingHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketing_hargas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lokasi_id');
            $table->string('nama_lokasi');
            $table->string('harga_dewasa')->nullable();
            $table->string('harga_anak')->nullable();
            $table->string('harga_bus_besar')->nullable();
            $table->string('harga_bus_kecil')->nullable();
            $table->string('harga_mobil')->nullable();
            $table->string('harga_motor')->nullable();
            $table->string('harga_sepeda')->nullable();
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
        Schema::dropIfExists('ticketing_hargas');
    }
}
