<?php

namespace App\Http\Controllers;

use App\Models\LongUrl;

class LongUrlController extends Controller
{
    // Retrieve all long urls with its shorten urls from the database
    public function findAll()
    {
        $longUrls = LongUrl::with('shortUrls')->withCount('shortUrls')->get();

        if ($longUrls->isEmpty()) {
            return response()->json(['message' => 'No LongUrls found']);
        }

        return response()->json($longUrls);
    }
}
