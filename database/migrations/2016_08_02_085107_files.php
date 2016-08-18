<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Files extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('files', function (Blueprint $table) {
        $table->increments('id_files');
        $table->timestamps();
        $table->string('file');
        $table->integer('id_activities')->unsigned();
      });

      Schema::table('files', function (Blueprint $table) {
        $table->foreign('id_activities')->references('id_activities')->on('activities')->onDelete('cascade')->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('files');
    }
}
