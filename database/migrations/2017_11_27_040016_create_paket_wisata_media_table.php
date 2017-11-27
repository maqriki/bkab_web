<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketWisataMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_wisata_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pw_id');
            $table->string('pwm_url')->nullable();
            $table->string('pwm_description')->nullable();
            $table->string('pwm_status')->nullable();
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
        Schema::dropIfExists('paket_wisata_media');
    }
}
