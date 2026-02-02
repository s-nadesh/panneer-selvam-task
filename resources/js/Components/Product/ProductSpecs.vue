<template>
    <div class="mb-6">
        <h3 class="font-bold mb-3 text-lg">Product Details</h3>
        <div class="grid grid-cols-2 gap-3">
            <SpecItem label="Brand" :value="brand" />
            <SpecItem label="Colour" :value="color" />
            <SpecItem label="Calculator Type" :value="type" />
            <SpecItem label="Power Source" :value="powerSource" />
        </div>
    </div>
</template>

<script setup>
import SpecItem from '@/Components/Product/SpecItem.vue';

defineProps({
    brand: String,
    color: String,
    type: String,
    powerSource: String
});
</script>