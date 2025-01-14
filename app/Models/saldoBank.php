<?php

namespace App\Models;

use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Database\Eloquent\Model;

class saldoBank extends Model
{
    public function namaBank()
    {
        return $this->belongsTo(namaBank::class);
    }
    public function saldoBanks()
    {
        return $this->belongsTo(User::class);
    }

    public function pemasukans()
    {
        return $this->hasMany(pemasukan::class);
    }

    public function pengeluarans()
    {
        return $this->hasMany(pengeluaran::class);
    }
}
