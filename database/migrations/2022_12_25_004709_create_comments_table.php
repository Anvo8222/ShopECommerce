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
    Schema::create('comments', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->text('comment');
      $table->unsignedInteger('level')->default(0);
      $table->unsignedBigInteger('id_blog');
      $table->unsignedBigInteger('id_user');
      $table->unsignedInteger('id_parent')->nullable();
      $table->foreign('id_blog')->references('id')->on('blogs');
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
    Schema::dropIfExists('comments');
  }
};