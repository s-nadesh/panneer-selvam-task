<script setup>
    const emit = defineEmits(['cancel'])
</script>

<template>
    <button @click="emit('cancel')">Cancel</button>
</template>