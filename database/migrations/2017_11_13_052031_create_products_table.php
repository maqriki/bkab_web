<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->increments('id');
      $table->string('prod_id');
      $table->string('prod_name');
      $table->string('prod_description');
      $table->string('prod_category');
      $table->string('prod_location');
      $table->string('prod_address');
      $table->string('prod_lat');
      $table->string('prod_long');
      $table->string('prod_price_usd');
      $table->string('prod_price_idr');
      $table->string('prod_retrib_usd');
      $table->string('prod_retrib_idr');
      $table->string('prod_image_path');
      $table->string('prod_url_image');
      $table->string('prod_status');
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
    Schema::dropIfExists('products');
  }
}
