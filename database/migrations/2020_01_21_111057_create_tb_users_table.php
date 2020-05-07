<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_universitas')->unsigned();
            $table->integer('id_fakultas')->unsigned();
            $table->String('nama',200);
            $table->String('username',100);
            $table->String('password');
            $table->String('tempat_lahir',200);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['laki','perempuan']);
            $table->String('alamat',100);
            $table->String('semester',100);
            $table->String('Program_studi',100);
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
        Schema::dropIfExists('tb_users');
    }
}
