<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrderTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('order_uid')->nullable();
            $table->string('uot_nama_lokasi')->nullable();
            $table->string('uot_id_lokasi')->nullable();
            $table->string('uot_tiket_dewasa')->nullable();
            $table->string('uot_retrib_dewasa')->nullable();
            $table->string('uot_ttl_retrib_dewasa')->nullable();
            $table->string('uot_tiket_anak')->nullable();
            $table->string('uot_retrib_anak')->nullable();
            $table->string('uot_ttl_retrib_anak')->nullable();
            $table->string('uot_start')->nullable();
            $table->string('uot_end')->nullable();
            $table->string('uot_status_payment')->nullable();
            $table->string('uot_status_kunjungan')->nullable();
            $table->string('uot_tgl_kunjungan')->nullable();
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
        Schema::dropIfExists('user_order_tickets');
    }
}
