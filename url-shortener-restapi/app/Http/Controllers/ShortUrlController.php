<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Services\RandomStringGeneratorService;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    
    public function __construct(
        protected LongUrlController $longUrlController,
        protected RandomStringGeneratorService $randomStringGeneratorService
    ) {
    }

    // Save the short url in the database
    public function shorten($longUrlId)
    {
        try {
            $longUrl = $this->longUrlController->findById($longUrlId);

            $shortUrl = new ShortUrl([
                'content' => $this->randomStringGeneratorService->generate(),
                'long_url_id' => $longUrl->id
            ]);

            $shortUrl->save();

            return response()->json(['short_url' => $shortUrl->content]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
