<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketWisataItenarariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_wisata_itenararies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pw_id');
            $table->string('pwi_itenerary')->nullable();
            $table->string('pwi_description_1')->nullable();
            $table->string('pwi_description_2')->nullable();
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
        Schema::dropIfExists('paket_wisata_itenararies');
    }
}
