<template>
    <div class="mb-4">
        <label class="block mb-2 font-medium">Quantity:</label>
        <select :value="modelValue" 
                @change="$emit('update:modelValue', parseInt($event.target.value))"
                class="border rounded p-2 w-32 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none">
            <option v-for="n in 10" :key="n" :value="n">{{ n }}</option>
        </select>
    </div>
</template>

<script setup>
defineProps({
    modelValue: {
        type: [Number, String],
        default: 1
    }
});

defineEmits(['update:modelValue']);
</script>