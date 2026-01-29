<script setup>
import Textarea from 'primevue/textarea'

const terms = defineModel()

</script>
<template>

    <div class="p-4">
        <label class="font-bold">Terms & Condition</label>
        <Textarea v-model="terms" rows='5' cols="30" class="w-full"/>
    </div>

</template>