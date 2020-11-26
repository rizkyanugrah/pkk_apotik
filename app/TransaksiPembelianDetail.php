<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obat;

class TransaksiPembelianDetail extends Model
{
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
    public function pembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class, 'transaksi_pembelian_id');
    }

    public function getCostAttribute()
    {
        $cost = $this->obat->harga_beli * $this->total_obat;
        return 'Rp. ' . number_format($cost, 0, ',', '.');
    }
}
