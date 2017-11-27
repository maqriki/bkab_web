<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketingKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketing_kendaraans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticketing_id');
            $table->string('id_ticketing')->nullable();
            $table->string('id_ticketing_online')->nullable();
            $table->string('jenis_kendaraan')->nullable();
            $table->string('total')->nullable();
            $table->string('harga_kendaraan')->nullable();
            $table->string('total_harga_kendaraan')->nullable();
            $table->string('operator')->nullable();
            $table->string('pembayaran')->nullable();
            $table->string('status_pesanan')->nullable();
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
        Schema::dropIfExists('ticketing_kendaraans');
    }
}
