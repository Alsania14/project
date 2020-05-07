<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPertemuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pertemuans', function (Blueprint $table) {
            $table->increments('id',10);
            $table->integer('id_pemesan')->unsigned();
            $table->integer('id_pengajar')->unsigned();
            $table->String('lokasi');
            $table->date('tanggal_pertemuan');
            $table->time('waktu_pertemuan');
            $table->enum('status',['pending','approved','reject'])->default('pending');
            $table->String('catatan_pengajar',100);
            $table->String('catatan_pemesan',100);
            $table->integer('bintang')->unsigned();
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
        Schema::dropIfExists('tb_pertemuans');
    }
}
