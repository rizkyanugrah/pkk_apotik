<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';

    public function obat()
    {
        return $this->hasMany(Obat::class);
    }
}
