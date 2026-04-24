<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrosCreados extends Model
{
    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getModelNameAttribute()
    {
        $fullClass = $this->attributes['model_type'];

        return basename(str_replace('\\', '/', $fullClass));
    }
}
