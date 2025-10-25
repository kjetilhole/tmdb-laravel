<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TMDBService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        $this->baseUrl = config('services.tmdb.base_url');
    }

    public function getRandomMovie()
    {
        $page = rand(1, 500);

        $response = Http::get(rtrim($this->baseUrl, '/') . '/discover/movie', [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'sort_by' => 'popularity.desc',
            'page' => $page,
        ]);

        if($response->successful()) {
            $data = $response->json();
            
            if(isset($data['results']) && is_array($data['results']) && count($data['results']) > 0) {
                return $data['results'][array_rand($data['results'])];
            } else {
                Log::warning('TMDBService: No movies found in results', ['response' => $data]);
            }
        } else {
            Log::error('TMDB API Error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }

        return null;
    }
}