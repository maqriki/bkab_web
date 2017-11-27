<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketOrderedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_ordered', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_ticket')->nullable();
            $table->string('user_id')->nullable();
            $table->string('ticket_dewasa')->nullable();
            $table->string('ticket_anak')->nullable();
            $table->string('retrib_anak')->nullable();
            $table->string('retrib_dewasa')->nullable();
            $table->string('total_retrib')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('ticket_ordereds');
    }
}
