<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDBService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        $this->baseUrl = config('services.tmdb.base_url');
    }

    /**
     * Get a random movie from the TMDB API
     */
    public function getRandomMovie(): ?array{
        $params = $this->defaultParams();

        // Step 1: fetch total pages
        $initial = Http::get(($this->baseUrl . 'discover/movie'), array_merge($params, ['page' => 1]));
        if(! $initial->successful()){
            return null;
        }

        $totalPages = min($initial->json('total_pages', 1), 500);

        // Step 2: pick a random page and a random movie from that page 
        for($i = 0; $i < 5; $i++) {
            $page = rand(1, $totalPages);
            $response = Http::get(($this->baseUrl . 'discover/movie'), array_merge($params, ['page' => $page]));

            if(! $response?->successful()) {
                continue;
            }

            $movies = $response->json('results', []);
            if(empty($movies)){
                continue;
            }

            $movie = $movies[array_rand($movies)];
            $details = $this->getMovieDetails($movie['id']);

            if($details){
                return $details;
            }
        }
        return null;
    }

    /**
     * Get detailed information about a movie
     */
    public function getMovieDetails($movieId){
        $response = Http::get(($this->baseUrl . 'movie/' . $movieId), [
            'api_key' => $this->apiKey,
        ]);

        if(!$response->successful()){
            return null;
        }

        return $response->json();
    }

    /**
     * Default parameters for all discover requests
     */
    public function defaultParams(): array{
        return [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'sort_by' => 'popularity.desc',
            'include_adult' => false,
            'vote_count.gte' => 1000,
        ];
    }
}