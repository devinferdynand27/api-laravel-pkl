<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_absensis', function (Blueprint $table) {
            $table->id();
            $table->text('foto');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_hari')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_hari')->references('id')->on('tb_haris');
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
        Schema::dropIfExists('tb_absensis');
    }
}
