<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pembeli',
        'tanggal_pembelian'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function details()
    {
        return $this->hasMany(TransaksiPenjualanDetail::class, "transaksi_penjualan_id");
    }

    public function getCostAttribute()
    {
        return 'Rp. ' . number_format(array_sum($this->details->map(function ($detail) {
            return $detail->obat->harga_beli * $detail->total_obat;
        })->toArray()), 0, ',', '.');
    }

    public function getTransactionDateAttribute()
    {
        return Carbon::parse($this->tanggal_pembelian)->format("d-m-Y");
    }
}
