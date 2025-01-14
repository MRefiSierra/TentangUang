<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class portofolio extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sekuritas()
    {
        return $this->hasMany(sekuritas::class);
    }
}
