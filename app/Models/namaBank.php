<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class namaBank extends Model
{
    public function saldoBank()
    {
        return $this->hasOne(saldoBank::class);
    }
}
