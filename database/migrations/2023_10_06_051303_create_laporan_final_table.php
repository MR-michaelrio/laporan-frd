<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanFinalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_final', function (Blueprint $table) {
            $table->increments('id_laporan');
            $table->string('nama_petugas');
            $table->text('kejadian');
            $table->string('tanggal');
            $table->integer('id_anggota')->unsigned();
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota');
            $table->integer('id_regu')->unsigned();;
            $table->foreign('id_regu')->references('id_regu')->on('regu');
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
        Schema::dropIfExists('laporan_final');
    }
}
