<template>
    <div class="border rounded p-3">
        <div class="flex justify-between items-center">
            <span class="font-semibold">{{ title }}</span>
            <button class="text-blue-600 hover:text-blue-800 transition">
                {{ offerCount }} offer >
            </button>
        </div>
        <p class="text-sm mt-1 text-gray-600">{{ description }}</p>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    description: String,
    offerCount: String
});
</script>