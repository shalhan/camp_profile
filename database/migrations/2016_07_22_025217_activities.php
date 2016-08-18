<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Activities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('activities', function (Blueprint $table) {
          $table->increments('id_activities');
          $table->timestamps();
          $table->string('nama_kegiatan');
          $table->integer('cakupan');
          $table->integer('category');
          $table->date('tgl_mulai');
          $table->date('tgl_selesai');
          $table->string('sumber_dana');
          $table->string('pencapaian');
          $table->text('deskripsi');
          $table->string('id_people');
          $table->integer('group');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('lecture_activities');
    }
}
