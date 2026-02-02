<template>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ name }}</h1>
        <div class="flex items-center mt-2 space-x-4 flex-wrap gap-2">
            <RatingStars :rating="rating" />
            <span class="text-blue-600">{{ rating || 4.2 }} ({{ reviewCount || 2032 }})</span>
            <AmazonChoiceBadge v-if="isAmazonChoice" />
            <MonthlySalesBadge :sales="monthlySales" />
        </div>
    </div>
</template>

<script setup>
import RatingStars from '@/Components/Product/RatingStars.vue';
import AmazonChoiceBadge from '@/Components/Product/AmazonChoiceBadge.vue';
import MonthlySalesBadge from '@/Components/Product/MonthlySalesBadge.vue';

defineProps({
    name: String,
    rating: Number,
    reviewCount: Number,
    isAmazonChoice: Boolean,
    monthlySales: Number
});
</script>