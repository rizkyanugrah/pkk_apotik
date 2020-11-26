<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'supplier_id',
        'satuan_id',
        'jenis_id',
        'kategori_id',
        'nama_obat',
        'aturan_minum',
        'indikasi',
        'harga_beli',
        'harga_jual',
        'is_expired',
        'tanggal_kadaluarsa',
        'gambar',
        'is_expired',
        'stok'
    ];
    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'id');
    }

    public function satuans()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
