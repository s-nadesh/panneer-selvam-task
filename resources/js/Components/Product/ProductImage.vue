<template>
    <div>
        <div class="border rounded-lg p-4">
            <img :src="imageUrl || 'https://via.placeholder.com/400x400'" 
                 :alt="name" 
                 class="w-full h-auto max-h-[400px] object-contain">
        </div>
    </div>
</template>

<script setup>
defineProps({
    imageUrl: String,
    name: String
});
</script>