<?php

namespace App\Livewire;

use App\Services\TMDBService;
use Livewire\Component;

class MovieGame extends Component
{
    public $leftMovie;
    public $rightMovie;
    public $loading = false;
    public $gameOver = false;
    
    public function mount(TMDBService $tmdbService)
    {
        $this->loadMovies($tmdbService);
    }

    public function swapRightMovie(TMDBService $tmdbService)
    {
        $this->loading = true;
        $this->rightMovie = $tmdbService->getRandomMovie();
        $this->loading = false;
    }

    public function loadNewMovies(TMDBService $tmdbService)
    {
        $this->loading = true;
        $this->loadMovies($tmdbService);
        $this->loading = false;
    }

    private function loadMovies(TMDBService $tmdbService)
    {
        $this->leftMovie = $tmdbService->getRandomMovie();
        $this->rightMovie = $tmdbService->getRandomMovie();
    }

    public function lowerRevenue(TMDBService $tmdbService)
    {
        // Correct guess, new rightMovie
        if($this->leftMovie['revenue'] > $this->rightMovie['revenue']){
            $this->swapRightMovie($tmdbService);
        } else {
            // Incorrect guess, game over
            $this->gameOver = true;
        }
    }

    public function render()
    {
        return view('livewire.movie-game');
    }
}