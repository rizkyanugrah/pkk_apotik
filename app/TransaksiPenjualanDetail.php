<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualanDetail extends Model
{
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
    public function penjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'transaksi_penjualan_id');
    }

    public function getCostAttribute()
    {
        $cost = $this->obat->harga_beli * $this->total_obat;
        return 'Rp. ' . number_format($cost, 0, ',', '.');
    }
}
