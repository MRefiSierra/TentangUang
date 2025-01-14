<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sekuritas extends Model
{
    public function portofolios()
    {
        return $this->belongsToMany(portofolio::class);
    }
}
