<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPertandingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pertandingans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jadwal_id')->unsigned();
            $table->string('keterangan');
            $table->string('tim1');
            $table->string('tim2');
            $table->string('cabor');
            $table->string('score');
            $table->string('lokasi');
            $table->timestamps();

            $table->foreign('jadwal_id')->references('id')->on('tb_jadwals')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pertandingans');
    }
}
