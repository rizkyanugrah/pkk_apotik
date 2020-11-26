<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Supplier;
use App\TransaksiPembelianDetail;
use Carbon\Carbon;

class TransaksiPembelian extends Model
{
    protected $fillable = [
        'user_id',
        'supplier_id',
        'tanggal_pembelian'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }
    public function details()
    {
        return $this->hasMany(TransaksiPembelianDetail::class, "transaksi_pembelian_id");
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
