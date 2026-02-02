<script setup>
defineProps({
  items: Array,
  total: Number
})
</script>

<template>
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Checkout</h1>

    <!-- Cart items -->
    <div v-for="item in items" :key="item.id"
         class="flex justify-between border-b py-3">
      <div>
        <p class="font-semibold">{{ item.product_name }}</p>
        <p class="text-sm text-gray-500">
          Qty: {{ item.quantity }}
        </p>
      </div>

      <p>₹ {{ item.product.price * item.quantity }}</p>
    </div>

    <!-- Total -->
    <div class="flex justify-between mt-6 text-xl font-bold">
      <span>Total</span>
      <span>₹ {{ total }}</span>
    </div>

    <!-- Continue -->
    <button class="mt-6 bg-yellow-400 px-6 py-3 rounded font-semibold">
      Place Order
    </button>
  </div>
</template>
