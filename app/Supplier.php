<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function obat()
    {
        return $this->hasMany(Obat::class);
    }
}
