<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_produks', function (Blueprint $table) {
            $table->mediumIncrements('id_produk');
            $table->unsignedMediumInteger('id_kategori')->nullable();
            $table->string('nama_produk', 200)->nullable();
            $table->string('kode_produk', 50)->nullable();
            $table->string('foto_produk_satu', 255)->nullable();
            $table->string('foto_produk_dua', 255)->nullable();
            $table->string('foto_produk_tiga', 255)->nullable();
            $table->dateTime('tgl_register')->nullable();
            $table->timestamps();

            // relasi id_kategori dengan tbl_kategoris
            $table->foreign('id_kategori')->references('id_kategori')->on('tbl_kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_produks');
    }
}
