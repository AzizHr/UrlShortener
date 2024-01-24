<?php

namespace App\Http\Controllers;

use App\Http\Requests\LongUrlRequest;
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

    // Find a long url by its ID
    public function findById($id)
    {
        try {
            return LongUrl::where('id', $id)->firstOrFail();
        } catch (\Exception $e) {
            throw new \Exception('No LongUrl was found with the provided id');
        }
    }

    // Save a long url in the database
    public function save(LongUrlRequest $request)
    {
        $longUrlData = $request->validated();
        $longUrl = LongUrl::create($longUrlData);
        return response()->json(['message' => 'LongUrl saved successfully', 'id' => $longUrl->id]);
    }

    // Get the most visited long url based on its shorten urls clicks
    public function getTheMostVisited()
    {
        $mostVisited = LongUrl::with('shortUrls')->withCount('shortUrls')
            ->orderByDesc('short_urls_count')
            ->first();

        if ($mostVisited == null) {
            return response()->json(['message' => 'There are no urls to check']);
        }

        return response()->json(['mostVisisted' => $mostVisited]);
    }
}
