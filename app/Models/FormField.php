<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = ['field_name', 'is_required'];

    protected $casts = [
        'is_required' => 'boolean',
    ];
}
