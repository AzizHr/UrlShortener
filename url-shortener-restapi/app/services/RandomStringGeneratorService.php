<?php

namespace App\Services;

use Illuminate\Support\Str;

class RandomStringGeneratorService
{
    public function generate(): string
    {
        return Str::random(8);
    }
}