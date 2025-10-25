<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Movie Comparison Game</h1>
        
        @if($loading)
            <div class="text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <p class="mt-2 text-gray-600">Loading movies...</p>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Movie -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        @if($leftMovie && isset($leftMovie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $leftMovie['poster_path'] }}" 
                                 alt="{{ $leftMovie['title'] }}" 
                                 class="w-full h-96 object-cover">
                        @else
                            <div class="w-full h-96 bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">No Image Available</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2">{{ $leftMovie['title'] ?? 'Unknown Movie' }}</h2>
                        <p class="text-gray-600 mb-2">{{ $leftMovie['release_date'] ?? 'Unknown Year' }}</p>
                        <div class="flex items-center mb-3">
                            <span class="text-yellow-500">★</span>
                            <span class="ml-1 font-semibold">{{ $leftMovie['vote_average'] ?? 'N/A' }}/10</span>
                        </div>
                        <p class="text-gray-700">{{ $leftMovie['overview'] ?? 'No overview available.' }}</p>
                    </div>
                </div>

                <!-- Right Movie -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        @if($rightMovie && isset($rightMovie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $rightMovie['poster_path'] }}" 
                                 alt="{{ $rightMovie['title'] }}" 
                                 class="w-full h-96 object-cover">
                        @else
                            <div class="w-full h-96 bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">No Image Available</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2">{{ $rightMovie['title'] ?? 'Unknown Movie' }}</h2>
                        <p class="text-gray-600 mb-2">{{ $rightMovie['release_date'] ?? 'Unknown Year' }}</p>
                        <div class="flex items-center mb-3">
                            <span class="text-yellow-500">★</span>
                            <span class="ml-1 font-semibold">{{ $rightMovie['vote_average'] ?? 'N/A' }}/10</span>
                        </div>
                        <p class="text-gray-700">{{ $rightMovie['overview'] ?? 'No overview available.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center gap-4 mt-8">
                <button wire:click="swapRightMovie" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Swap Right Movie
                </button>
                <button wire:click="loadNewMovies" 
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Load New Movies
                </button>
            </div>
        @endif
    </div>
</div>