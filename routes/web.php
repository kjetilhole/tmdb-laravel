<?php

use Illuminate\Support\Facades\Route;
use App\Services\TMDBService;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/random-movie', function (TMDBService $tmdbService) {
    $movie = $tmdbService->getRandomMovie();
    
    if (!$movie) {
        return response()->json(['error' => 'Failed to fetch movie'], 500);
    }
    
    return response()->json($movie);
});