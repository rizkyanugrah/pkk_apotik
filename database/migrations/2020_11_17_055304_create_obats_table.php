<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->integer('satuan_id')->unsigned();
            $table->integer('jenis_id')->unsigned();
            $table->integer('kategori_id')->unsigned();

            $table->string('nama_obat');
            $table->string('aturan_minum');
            $table->string('indikasi');
            $table->bigInteger('harga_beli');
            $table->bigInteger('harga_jual');
            $table->boolean('is_expired');
            $table->date('tanggal_kadaluarsa');
            $table->string('gambar');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('satuan_id')->references('id')->on('satuans')->onDelete('cascade');
            $table->foreign('jenis_id')->references('id')->on('jenis')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obats');
    }
}
