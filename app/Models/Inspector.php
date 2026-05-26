<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    protected $fillable = ['nombre'];

    public function resumens()
    {
        return $this->hasMany(Resumen::class);
    }
}
