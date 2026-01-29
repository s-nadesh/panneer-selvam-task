<script setup>

    const emit = defineEmits(['clicked']);

</script>

<template>
    <button @click="emit('clicked')">
        Save
    </button>
</template>