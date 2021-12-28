<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreIgnId('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreIgnId('penilaian_id')->references('id')->on('penilaian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_siswa');
    }
}
