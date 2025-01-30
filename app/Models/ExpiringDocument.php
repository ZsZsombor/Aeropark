<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpiringDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'document_type',
        'expiration_date',
        'file_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
