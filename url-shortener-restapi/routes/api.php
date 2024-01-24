<?php

use App\Http\Controllers\LongUrlController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('long-urls', [LongUrlController::class, 'findAll'])->name('long-urls.findAll');
Route::get('long-urls/{id}', [LongUrlController::class, 'findById'])->name('long-urls.findById');
Route::get('most-visited', [LongUrlController::class, 'getTheMostVisited'])->name('mostVisited');
Route::post('long-urls/create', [LongUrlController::class, 'save'])->name('long-urls.save');
Route::post('long-urls/{id}/shorten', [ShortUrlController::class, 'shorten'])->name('long-urls.shorten');
Route::get('{shortUrlContent}', [ShortUrlController::class, 'redirectToOriginalUrl'])->name('redirect.to.original');
