<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLokasiWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::create('lokasi_wisata', function (Blueprint $table) {
        $table->increments('id');
        $table->string('lokasi_id');
        $table->string('lokasi_name');
        $table->string('lokasi_type');
        $table->string('lokasi_description');
        $table->string('lokasi_start');
        $table->string('lokasi_end');
        $table->string('lokasi_category');
        $table->string('lokasi_location');
        $table->string('lokasi_address');
        $table->string('lokasi_lat');
        $table->string('lokasi_long');
        $table->string('lokasi_image_path');
        $table->string('lokasi_url_image');
        $table->string('lokasi_status');
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
        Schema::dropIfExists('lokasi_wisatas');
    }
}
