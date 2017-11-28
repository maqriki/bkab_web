<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('order_uid')->nullable();
            $table->string('ttl_item_all')->nullable();
            $table->string('ttl_item_tiket')->nullable();
            $table->string('ttl_person_tiket')->nullable();
            $table->string('ttl_tagihan_tiket')->nullable();
            $table->string('ttl_item_paket')->nullable();
            $table->string('ttl_person_paket')->nullable();
            $table->string('ttl_tagihan_paket')->nullable();
            $table->string('ttl_tagihan')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status_payment')->nullable();
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
        Schema::dropIfExists('user_orders');
    }
}
