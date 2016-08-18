<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lectures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('lectures', function (Blueprint $table) {
          $table->increments('id_lecture');
          $table->timestamps();
          $table->string('nama');
          $table->string('username');
          $table->string('url');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('lectures');
    }
}
