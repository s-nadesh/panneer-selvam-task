<template>
    <div class="mb-6">
        <div class="flex items-center space-x-2">
            <span class="text-3xl font-bold">₹{{ price }}</span>
            <span class="text-gray-500 line-through">M.R.P.: ₹{{ mrp || 165 }}</span>
            <span class="text-green-600 font-semibold">
                -{{ discountedPrice || 5 }}%
            </span>
        </div>
        <div class="mt-2">
            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                Inclusive of all taxes
            </span>
        </div>
    </div>
</template>

<script setup>
defineProps({
    price: Number,
    mrp: Number,
    discountedPrice: Number
});
</script>