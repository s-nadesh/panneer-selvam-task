<template>
    <header class="bg-[#232F3E] text-white p-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <inertia-link href="/" class="text-2xl font-bold">Amazon.in</inertia-link>
                    <div class="text-sm">
                        <slot name="delivery-info">
                            <span>Delivering to Mumbai 400001</span>
                            <button class="ml-2 text-blue-300">Update location</button>
                        </slot>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <CartIcon :count="cartCount" @openCart="$emit('openCart')"/>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import CartIcon from '@/Components/CartIcon.vue';

defineProps({
    cartCount: {
        type: Number,
        default: 0
    }
});
defineEmits(['openCart']);
</script>