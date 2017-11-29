<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrderPaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order_pakets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('order_uid')->nullable();
            $table->string('uop_guide_id')->nullable();
            $table->string('uop_nama_paket')->nullable();
            $table->string('uop_id_paket')->nullable();
            $table->string('uop_paket_person')->nullable();
            $table->string('uop_price_idr_person')->nullable();
            $table->string('uop_price_usd_person')->nullable();
            $table->string('uop_tprice_idr_person')->nullable();
            $table->string('uop_tprice_usd_person')->nullable();
            $table->string('uop_status_kunjungan')->nullable();
            $table->string('uop_tanggal_kunjungan')->nullable();
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
        Schema::dropIfExists('user_order_pakets');
    }
}
