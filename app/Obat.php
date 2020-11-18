<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $guarded = [];

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
