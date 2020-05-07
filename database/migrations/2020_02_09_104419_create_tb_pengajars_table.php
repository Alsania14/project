<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPengajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengajars', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('id_member')->unsigned();
            $table->String('nama_pa',100);
            $table->String('nip_pa',20);
            $table->String('file_krt_mhs');
            $table->String('file_ket_pa');
            $table->enum('status',['approved','pending','failed'])->default('pending');
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
        Schema::dropIfExists('tb_pengajars');
    }
}
