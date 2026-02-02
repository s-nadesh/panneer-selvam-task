<template>
    <button @click="buyNow" 
            class="flex-1 bg-orange-400 hover:bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
        Buy Now
    </button>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    productId: [String, Number],
    quantity: {
        type: Number,
        default: 1
    }
});

const form = useForm({
    quantity: props.quantity
});

const buyNow = () => {
    form.post(`/product/${props.productId}/add-to-cart`, {
        onSuccess: () => {
            window.location.href = '/checkout';
        }
    });
};
</script>