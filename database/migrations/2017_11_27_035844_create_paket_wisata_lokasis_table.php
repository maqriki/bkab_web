<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketWisataLokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_wisata_lokasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pw_id');
            $table->string('lokasi_id')->nullable();
            $table->string('lokasi_nama')->nullable();
            $table->string('lokasi_start')->nullable();
            $table->string('lokasi_end')->nullable();
            $table->string('lokasi_status')->nullable();
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
        Schema::dropIfExists('paket_wisata_lokasis');
    }
}
