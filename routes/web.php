<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Livewire\MovieGame;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movie-game', MovieGame::class);