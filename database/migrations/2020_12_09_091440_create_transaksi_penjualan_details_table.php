<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPenjualanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penjualan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi_penjualan_id')->unsigned();
            $table->integer('obat_id')->unsigned();
            $table->bigInteger('total_obat');
            $table->timestamps();
            $table->foreign('transaksi_penjualan_id')->references('id')->on('transaksi_penjualans')->onDelete('cascade');
            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_penjualan_details');
    }
}
