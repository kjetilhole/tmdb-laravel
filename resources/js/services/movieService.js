/**
 * Fetch a random movie from the API
 * @returns {Promise<Object|null>} Movie object or null if error
 */
export const getRandomMovie = async () => {
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

