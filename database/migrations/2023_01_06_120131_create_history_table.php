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
    Schema::create('histories', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('email');
      $table->double('phone');
      $table->string('name');
      $table->double('price');
      $table->unsignedBigInteger('id_user');
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
    Schema::dropIfExists('history');
  }
};