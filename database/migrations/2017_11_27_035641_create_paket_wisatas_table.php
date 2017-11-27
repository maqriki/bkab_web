<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_wisatas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pw_id');
            $table->string('pw_name')->nullable();
            $table->longtext('pw_description')->nullable();
            $table->string('pw_category')->nullable();
            $table->string('pw_price_usd')->nullable();
            $table->string('pw_price_idr')->nullable();
            $table->string('pw_total_location')->nullable();
            $table->string('pw_start');
            $table->string('pw_end');
            $table->string('pw_duration')->nullable();
            $table->string('pw_url_image')->nullable();
            $table->string('pw_url_video')->nullable();
            $table->string('pw_slug')->nullable();
            $table->string('pw_status')->nullable();
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
        Schema::dropIfExists('paket_wisatas');
    }
}
