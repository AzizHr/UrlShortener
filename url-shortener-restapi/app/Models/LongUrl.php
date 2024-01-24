<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LongUrl extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'content'
    ];

    public function shortUrls(): HasMany
    {
        return $this->hasMany(ShortUrl::class);
    }
}
