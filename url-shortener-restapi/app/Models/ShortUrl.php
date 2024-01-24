<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'long_url_id'
    ];

    public function longUrl(): BelongsTo
    {
        return $this->belongsTo(LongUrl::class);
    }
}
