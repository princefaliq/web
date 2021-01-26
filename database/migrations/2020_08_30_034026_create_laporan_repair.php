<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanRepair extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_repair', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik',191);
            $table->string('nama',191);
            $table->string('bagian',191);
            $table->string('shift',191);
            $table->integer('bahan_2_0');
            $table->integer('bahan_3_1');
            $table->integer('bahan_bc');
            $table->integer('bahan_lc_31');
            $table->integer('total');
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
        Schema::dropIfExists('laporan_repair');
    }
}
