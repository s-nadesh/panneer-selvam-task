<template>
    <div class="mt-4 p-3 bg-green-100 text-green-700 rounded border border-green-200">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ message }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    message: String
});
</script>