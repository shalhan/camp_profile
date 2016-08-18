<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Papers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('papers', function (Blueprint $table) {
          $table->increments('id_paper');
          $table->timestamps();
          $table->string('judul');
          $table->string('author');
          $table->string('jurnal');
          $table->string('vol');
          $table->integer('citedby');
          $table->integer('year');
          $table->string('id_dosen');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('papers');
    }
}
