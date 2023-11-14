<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPengumpulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengumpulans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_tugas')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->string('status');
            $table->string('isi_tugas');
            $table
                ->foreign('id_tugas')
                ->references('id')
                ->on('tb_tugas_siswas');
            $table
                ->foreign('id_user')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('tb_pengumpulans');
    }
}
