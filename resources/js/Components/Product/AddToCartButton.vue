<template>
    <button @click="addToCart" 
            :disabled="processing"
            class="flex-1 bg-yellow-400 hover:bg-yellow-500 disabled:bg-yellow-300 text-gray-900 font-semibold py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center">
        <span v-if="processing" class="flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Adding...
        </span>
        <span v-else>Add to Cart</span>
    </button>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    productId: [String, Number],
    quantity: {
        type: Number,
        default: 1
    }
});

const emit = defineEmits(['added']);

const processing = ref(false);

const addToCart = () => {
    processing.value = true;
    
    router.post(`/product/${props.productId}/add-to-cart`, {
        quantity: props.quantity
    }, {
        preserveScroll: true,
        preserveState: false, // Set to false to allow flash messages
        onSuccess: () => {
            processing.value = false;
            emit('added');
        }
    });
};
</script>