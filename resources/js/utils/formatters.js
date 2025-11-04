/**
 * Format a number with US locale formatting
 * @param {number} num - The number to format
 * @returns {string} Formatted number string
 */
export const formatNumber = (num) => {
    return new Intl.NumberFormat("en-US").format(num);
};

export const formatDateToYear = (date) => {
    return new Date(date).getFullYear();
}

export const roundToDecimals = (value, decimals = 0) => {
    if(typeof value !== 'number') {
        return value;
    }
    const multiplier = Math.pow(10, decimals);
    return Math.round(value * multiplier) / multiplier;
}
