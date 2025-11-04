import { ref } from "vue";
import { getRandomMovie } from "../services/movieService.js";

/**
 * Composable for managing movie game state and logic
 * @returns {Object} Game state and methods
 */
export const useMovieGame = () => {
    const leftMovie = ref(null);
    const rightMovie = ref(null);
    const loading = ref(false);
    const correctGuesses = ref(0);
    const gameOver = ref(false);

    /**
     * Handle a guess (higher or lower revenue)
     * @param {string} direction - 'higher' or 'lower'
     */
    const guess = async (direction) => {
        if (
            (direction === "lower" &&
                leftMovie.value.revenue > rightMovie.value.revenue) ||
            (direction === "higher" &&
                leftMovie.value.revenue < rightMovie.value.revenue)
        ) {
            // Correct guess
            leftMovie.value = rightMovie.value;
            rightMovie.value = null;
            rightMovie.value = await getRandomMovie();
            correctGuesses.value++;
        } else {
            // Incorrect guess
            gameOver.value = true;
        }
    };

    /**
     * Load initial movies for the game
     */
    const loadMovies = async () => {
        loading.value = true;
        const [movie1, movie2] = await Promise.all([
            getRandomMovie(),
            getRandomMovie(),
        ]);
        leftMovie.value = movie1;
        rightMovie.value = movie2;
        loading.value = false;
    };

    /**
     * Swap the right movie with a new random movie
     */
    const swapRightMovie = async () => {
        rightMovie.value = null;
        rightMovie.value = await getRandomMovie();
    };

    return {
        leftMovie,
        rightMovie,
        loading,
        correctGuesses,
        gameOver,
        guess,
        loadMovies,
        swapRightMovie,
    };
};

