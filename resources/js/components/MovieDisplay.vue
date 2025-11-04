<template>
    <div class="movie-display">
        <h1 class="text-4xl font-bold text-center mb-8">Movie Comparison</h1>

        <div v-if="loading" class="text-center py-8">
            <div
                class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"
            ></div>
            <p class="mt-2 text-gray-600">Loading movies...</p>
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Movie -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="aspect-w-16 aspect-h-9">
                    <img
                        v-if="leftMovie && leftMovie.poster_path"
                        :src="`https://image.tmdb.org/t/p/w500${leftMovie.poster_path}`"
                        :alt="leftMovie.title"
                        class="w-full h-96 object-cover"
                    />
                    <MovieCardSkeleton v-else show-image />
                </div>
                <div class="p-6">
                    <h2 v-if="leftMovie?.title" class="text-2xl font-bold mb-2">
                        {{ leftMovie.title }}
                    </h2>
                    <MovieCardSkeleton v-else show-title title-width="80%" />
                    
                    <p v-if="leftMovie?.release_date" class="text-gray-600 mb-2">
                        {{ formatDateToYear(leftMovie.release_date) }}
                    </p>
                    <MovieCardSkeleton v-else show-text text-width="30%" />
                    
                    <div v-if="leftMovie?.vote_average !== undefined && leftMovie?.vote_average !== null" class="flex items-center mb-3">
                        <span class="text-yellow-500">★</span>
                        <span class="ml-1 font-semibold">
                            {{ roundToDecimals(leftMovie.vote_average, 1) }}/10
                        </span>
                    </div>
                    <MovieCardSkeleton v-else show-rating />
                    
                    <p v-if="leftMovie?.revenue" class="text-gray-700 mb-2">
                        Revenue: ${{ formatNumber(leftMovie.revenue) }}
                    </p>
                    <MovieCardSkeleton v-else show-text text-width="50%" />
                    
                    <p v-if="leftMovie?.overview" class="text-gray-700">
                        {{ leftMovie.overview }}
                    </p>
                    <MovieCardSkeleton v-else show-overview />
                </div>
            </div>

            <!-- Right Movie -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="aspect-w-16 aspect-h-9">
                    <img
                        v-if="rightMovie && rightMovie.poster_path"
                        :src="`https://image.tmdb.org/t/p/w500${rightMovie.poster_path}`"
                        :alt="rightMovie.title"
                        class="w-full h-96 object-cover"
                    />
                    <MovieCardSkeleton v-else show-image />
                </div>
                <div class="p-6">
                    <h2 v-if="rightMovie?.title" class="text-2xl font-bold mb-2">
                        {{ rightMovie.title }}
                    </h2>
                    <MovieCardSkeleton v-else show-title title-width="80%" />
                    
                    <p v-if="rightMovie?.release_date" class="text-gray-600 mb-2">
                        {{ formatDateToYear(rightMovie.release_date) }}
                    </p>
                    <MovieCardSkeleton v-else show-text text-width="30%" />
                    
                    <div v-if="rightMovie?.vote_average !== undefined && rightMovie?.vote_average !== null" class="flex items-center mb-3">
                        <span class="text-yellow-500">★</span>
                        <span class="ml-1 font-semibold">
                            {{ roundToDecimals(rightMovie.vote_average, 1) }}/10
                        </span>
                    </div>
                    <MovieCardSkeleton v-else show-rating />
                    
                    <p v-if="rightMovie?.revenue" class="text-gray-700 mb-2">
                        Revenue: ${{ formatNumber(rightMovie.revenue) }}
                    </p>
                    <MovieCardSkeleton v-else show-text text-width="50%" />
                    
                    <p v-if="rightMovie?.overview" class="text-gray-700 mb-4">
                        {{ rightMovie.overview }}
                    </p>
                    <MovieCardSkeleton v-else show-overview />
                    
                    <div v-if="rightMovie" class="flex gap-3 mt-4">
                        <button
                            @click="guess('lower')"
                            class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-3 px-6 rounded-lg transition duration-200"
                        >
                            Lower Revenue
                        </button>
                        <button
                            @click="guess('higher')"
                            class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-3 px-6 rounded-lg transition duration-200"
                        >
                            Higher Revenue
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Swap Button -->
        <div class="flex justify-center mt-8">
            <button
                @click="swapRightMovie"
                :disabled="loading"
                class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-3 px-6 rounded-lg transition duration-200"
            >
                Swap Right Movie
            </button>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import { useMovieGame } from "../composables/useMovieGame.js";
import { formatNumber, formatDateToYear, roundToDecimals } from "../utils/formatters.js";
import MovieCardSkeleton from "./MovieCardSkeleton.vue";

const {
    leftMovie,
    rightMovie,
    loading,
    correctGuesses,
    gameOver,
    guess,
    loadMovies,
    swapRightMovie,
} = useMovieGame();

onMounted(() => {
    loadMovies();
});
</script>

<style scoped>
.movie-display {
    min-height: 100vh;
    padding: 2rem;
    background-color: #f3f4f6;
}
</style>
