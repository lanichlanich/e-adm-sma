<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->string('judul');
            $table->string('dari');
            $table->string('keterangan')->nullable();
            $table->date('tgl_surat');
            $table->string('softfile')->nullable();
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
        Schema::dropIfExists('s_masuks');
    }
}
