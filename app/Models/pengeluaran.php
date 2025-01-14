<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class pengeluaran extends Model
{
    public function user()
    {
        return $this->belongsTo(Controller::class);
    }

    public function saldoBank(){
        return $this->belongsTo(saldoBank::class);
    }
}
