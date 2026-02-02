<template>
    <span class="text-green-700 whitespace-nowrap">
        {{ sales || 1000 }}+ bought in past month
    </span>
</template>

<script setup>
defineProps({
    sales: Number
});
</script>