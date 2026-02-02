<template>
    <div class="flex items-center">
        <span class="text-gray-600 min-w-[120px]">{{ label }}:</span>
        <span class="ml-2 font-medium">{{ value || getDefaultValue(label) }}</span>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    label: String,
    value: String
});

const getDefaultValue = (label) => {
    const defaults = {
        'Brand': 'Casio',
        'Colour': 'Black',
        'Calculator Type': 'Standard Function',
        'Power Source': 'Battery Powered'
    };
    return defaults[label] || '';
};
</script>