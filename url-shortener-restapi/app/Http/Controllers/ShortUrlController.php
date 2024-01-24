<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Services\RandomStringGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    // Get a short url by its content
    public function findByContent($content)
    {
        try {
            return ShortUrl::where('content', $content)->firstOrFail();
        } catch (\Exception $e) {
            throw new \Exception('No ShortUrl was found with the provided content');
        }
    }

    // Redirect to the original url if the short one has been clicked
    public function redirectToOriginalUrl($shortUrlContent)
    {
        try {
            $shortUrl = $this->findByContent($shortUrlContent);
            $longUrl = $this->longUrlController->findById($shortUrl->long_url_id);

            if ($longUrl) {
                $this->incrementClicks($shortUrl);
                return Redirect::to($longUrl->content);
            }

            abort(404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    // Increment the clicks by 1 each time the short url has been clicked
    public function incrementClicks(ShortUrl $shortUrl)
    {
        $shortUrl->clicks += 1;
        $shortUrl->save();
    }
}
