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
}
