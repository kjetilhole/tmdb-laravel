<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;

class MovieController extends Controller
{
    public function showRandom(TMDBService $tmdb)
    {
        $movie = $tmdb->getRandomMovie();

        return view('random-movie', compact('movie'));
    }
}