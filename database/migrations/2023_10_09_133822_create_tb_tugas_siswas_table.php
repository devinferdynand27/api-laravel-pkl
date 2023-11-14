<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTugasSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tugas_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('Tugas');
            $table->bigInteger('id_hari')->unsigned();
            $table->bigInteger('id_kelas')->unsigned();
            $table->bigInteger('id_mapel')->unsigned();
            $table
                ->foreign('id_hari')
                ->references('id')
                ->on('tb_haris');
            $table
                ->foreign('id_kelas')
                ->references('id')
                ->on('tb_kelas');
            $table
                ->foreign('id_mapel')
                ->references('id')
                ->on('tb_mapels');
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
        Schema::dropIfExists('tb_tugas_siswas');
    }
}
