<template>
     <button @click="$emit('openCart')" class="relative p-2 hover:bg-gray-100 rounded-full">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span v-if="count > 0" class="absolute -top-2 -right-2 bg-yellow-500 text-black rounded-full w-6 h-6 flex items-center justify-center text-xs">
            {{ count }}
        </span>
    </button>
</template>

<script setup>
defineProps({
    count: {
        type: Number,
        default: 0
    }
});

defineEmits(['openCart']);
</script>