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
                    <div
                        v-else
                        class="w-full h-96 bg-gray-300 flex items-center justify-center"
                    >
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-2">
                        {{ leftMovie?.title || "Unknown Movie" }}
                    </h2>
                    <p class="text-gray-600 mb-2">
                        {{ leftMovie?.release_date || "Unknown Year" }}
                    </p>
                    <div class="flex items-center mb-3">
                        <span class="text-yellow-500">★</span>
                        <span class="ml-1 font-semibold"
                            >{{ leftMovie?.vote_average || "N/A" }}/10</span
                        >
                    </div>
                    <p class="text-gray-700 mb-2">
                        Revenue: ${{ formatNumber(leftMovie?.revenue || 0) }}
                    </p>
                    <p class="text-gray-700">
                        {{ leftMovie?.overview || "No overview available." }}
                    </p>
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
                    <div
                        v-else
                        class="w-full h-96 bg-gray-300 flex items-center justify-center"
                    >
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-2">
                        {{ rightMovie?.title || "Unknown Movie" }}
                    </h2>
                    <p class="text-gray-600 mb-2">
                        {{ rightMovie?.release_date || "Unknown Year" }}
                    </p>
                    <div class="flex items-center mb-3">
                        <span class="text-yellow-500">★</span>
                        <span class="ml-1 font-semibold"
                            >{{ rightMovie?.vote_average || "N/A" }}/10</span
                        >
                    </div>
                    <p class="text-gray-700 mb-2">
                        Revenue: ${{ formatNumber(rightMovie?.revenue || 0) }}
                    </p>
                    <p class="text-gray-700">
                        {{ rightMovie?.overview || "No overview available." }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Swap Button -->
        <div class="flex justify-center mt-8">
            <button
                @click="swapMovies"
                :disabled="loading"
                class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-3 px-6 rounded-lg transition duration-200"
            >
                Swap Movies
            </button>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const leftMovie = ref(null);
const rightMovie = ref(null);
const loading = ref(false);

const fetchRandomMovie = async () => {
    try {
        const response = await fetch("/api/random-movie");
        if (!response.ok) {
            throw new Error("Failed to fetch movie");
        }
        return await response.json();
    } catch (error) {
        console.error("Error fetching movie:", error);
        return null;
    }
};

const loadMovies = async () => {
    loading.value = true;
    const [movie1, movie2] = await Promise.all([
        fetchRandomMovie(),
        fetchRandomMovie(),
    ]);
    leftMovie.value = movie1;
    rightMovie.value = movie2;
    loading.value = false;
};

const swapMovies = () => {
    const temp = leftMovie.value;
    leftMovie.value = rightMovie.value;
    rightMovie.value = temp;
};

const formatNumber = (num) => {
    return new Intl.NumberFormat("en-US").format(num);
};

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
