<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->integer('kelas_id')->unsigned()->nullable();
            $table->integer('roles')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('tb_kelas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
