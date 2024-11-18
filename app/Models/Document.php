<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'permit_id',
        'name',
        'type',
        'url',
    ];

    public function permit(): BelongsTo
    {
        return $this->belongsTo(Permit::class);
    }
}