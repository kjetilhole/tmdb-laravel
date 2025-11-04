<template>
    <div class="skeleton-container">
        <!-- Image skeleton -->
        <div v-if="showImage" class="skeleton-image w-full h-96 bg-gray-200 animate-pulse rounded"></div>
        
        <!-- Title skeleton -->
        <div v-if="showTitle" class="skeleton-title h-8 bg-gray-200 animate-pulse rounded mb-2" :style="{ width: titleWidth }"></div>
        
        <!-- Text skeleton -->
        <div v-if="showText" class="skeleton-text h-4 bg-gray-200 animate-pulse rounded mb-2" :style="{ width: textWidth }"></div>
        
        <!-- Rating skeleton -->
        <div v-if="showRating" class="skeleton-rating h-6 bg-gray-200 animate-pulse rounded mb-3" :style="{ width: '60px' }"></div>
        
        <!-- Overview skeleton -->
        <div v-if="showOverview" class="skeleton-overview space-y-2">
            <div class="h-4 bg-gray-200 animate-pulse rounded" style="width: 100%"></div>
            <div class="h-4 bg-gray-200 animate-pulse rounded" style="width: 95%"></div>
            <div class="h-4 bg-gray-200 animate-pulse rounded" style="width: 90%"></div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    showImage: {
        type: Boolean,
        default: false
    },
    showTitle: {
        type: Boolean,
        default: false
    },
    showText: {
        type: Boolean,
        default: false
    },
    showRating: {
        type: Boolean,
        default: false
    },
    showOverview: {
        type: Boolean,
        default: false
    },
    titleWidth: {
        type: String,
        default: '80%'
    },
    textWidth: {
        type: String,
        default: '40%'
    }
});
</script>

<style scoped>
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

