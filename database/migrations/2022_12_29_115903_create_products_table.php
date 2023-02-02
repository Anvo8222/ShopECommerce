<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->double('price');
      $table->unsignedInteger('status')->default(1)->comment = '0,1';
      $table->unsignedInteger('sale')->default(0);
      $table->string('company')->nullable();
      $table->ipAddress('image');
      $table->text('detail');
      $table->unsignedBigInteger('id_category');
      $table->unsignedBigInteger('id_brand');
      $table->unsignedBigInteger('id_user');
      $table->foreign('id_category')->references('id')->on('categories');
      $table->foreign('id_brand')->references('id')->on('brands');
      $table->foreign('id_user')->references('id')->on('users');
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
};