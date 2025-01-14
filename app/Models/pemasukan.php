<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SaldoBankController;
use Illuminate\Database\Eloquent\Model;

class pemasukan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function saldoBank()
    {
        return $this->belongsTo(saldoBank::class);
    }
}
