<template>
    <div class="min-h-screen max-w-screen-2xl mx-auto p-4 bg-graybase-600">
        <h1 class="text-4xl font-bold text-center mb-8">Movie Comparison</h1>

        <div v-if="loading" class="text-center py-8">
            <div
                class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"
            ></div>
            <p class="mt-2 text-gray-600">Loading movies...</p>
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <MovieCard :movie="leftMovie" />

            <MovieCard
                :movie="rightMovie"
                showButtons
                @guess="guess"
            />
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
import MovieCard from "./MovieCard.vue";

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
