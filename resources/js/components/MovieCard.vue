<template>
    <div class="bg-graybase-500 rounded-lg overflow-hidden">
        <!-- Poster -->
        <div class="aspect-w-16 aspect-h-9">
            <img
                v-if="movie && movie.poster_path"
                :src="`https://image.tmdb.org/t/p/w500${movie.poster_path}`"
                :alt="movie.title"
                class="w-full h-96 object-cover"
            />
            <MovieCardSkeleton v-else show-image />
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Title -->
            <h2 v-if="movie?.title" class="text-2xl font-bold text-white-100 mb-2 truncate">
                {{ movie.title }}
            </h2>
            <MovieCardSkeleton v-else show-title title-width="80%" />

            <!-- Release Year -->
            <p v-if="movie?.release_date" class="text-graybase-100 mb-4">
                {{ formatDateToYear(movie.release_date) }}
            </p>
            <MovieCardSkeleton v-else show-text text-width="30%" />

            <!-- Rating -->
            <div v-if="movie?.vote_average !== undefined && movie?.vote_average !== null" class="flex items-center mb-4">
                <svg class="w-5 h-5 text-accent-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.96h4.17c.969 0 1.371 1.24.588 1.81l-3.37 2.447 1.286 3.96c.3.921-.755 1.688-1.54 1.182L10 13.347l-3.37 2.447c-.784.506-1.839-.261-1.54-1.182l1.286-3.96-3.37-2.447c-.784-.57-.38-1.81.588-1.81h4.17l1.286-3.96z"></path>
                </svg>
                <span class="ml-2 text-white-100 font-semibold">{{ roundToDecimals(movie.vote_average, 1) }}/10</span>
            </div>
            <MovieCardSkeleton v-else show-rating />

            <!-- Revenue -->
            <div v-if="movie?.revenue && !showButtons" class="text-rarity-arcana font-bold text-lg">
                ${{ formatNumber(movie.revenue) }}
            </div>
            <MovieCardSkeleton v-if="!movie && !showButtons" show-text text-width="50%" />
            
            <!-- Buttons (optional) -->
            <div v-if="showButtons" class="flex gap-3 mt-4 font-druk-wide text-graybase-800">
                <button
                    @click="$emit('guess', 'lower')"
                    class="bg-rarity-ancient py-3 px-6 rounded-lg transition duration-200 w-full uppercase hover:bg-rarity-ancient/80 cursor-pointer"
                >
                    Lower
                </button>
                <button
                    @click="$emit('guess', 'higher')"
                    class="bg-rarity-arcana py-3 px-6 rounded-lg transition duration-200 w-full uppercase hover:bg-rarity-arcana/80 cursor-pointer"
                >
                    Higher
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import MovieCardSkeleton from '@/Components/MovieCardSkeleton.vue'
    import { formatDateToYear, roundToDecimals, formatNumber } from '../utils/formatters.js'

    // Props
    defineProps({
        movie: {
            type: Object,
            required: false,
        },
        showButtons: {
            type: Boolean,
            default: false,
        },
    })
  
    // Emits
    defineEmits(['guess'])
</script>