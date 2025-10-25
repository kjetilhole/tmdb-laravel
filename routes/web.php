<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Livewire\MovieGame;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/random-movie', [MovieController::class, 'showRandom']);
Route::get('/movie-game', MovieGame::class);