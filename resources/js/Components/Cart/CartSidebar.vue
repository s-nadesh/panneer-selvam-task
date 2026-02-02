<template>
    <!-- Cart Sidebar -->
    <div class="fixed inset-0 overflow-hidden z-50" v-if="isOpen">
        <!-- Background overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity" @click="closeCart"></div>
        
        <!-- Sidebar panel -->
        <div class="absolute inset-y-0 right-0 max-w-full flex">
            <div class="relative w-screen max-w-md">
                <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
                    <!-- Header -->
                    <div class="flex-1 py-6 px-4 sm:px-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-lg font-medium text-gray-900">
                                Shopping Cart ({{ cartData.itemCount }})
                            </h2>
                            <button @click="closeCart" class="ml-3 h-7 w-7 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Close panel</span>
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Cart Items -->
                        <div class="mt-8">
                            <div class="flow-root">
                                <ul role="list" class="-my-6 divide-y divide-gray-200">
                                    <!-- Empty State -->
                                    <li v-if="cartItems.length === 0" class="py-6 text-center">
                                        <div class="text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <p class="mt-2">Your cart is empty</p>
                                        </div>
                                    </li>

                                    <!-- Cart Items List -->
                                    <li v-for="item in cartItems" :key="item.id" class="py-6 flex">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                            <img :src="item.image_url || 'https://via.placeholder.com/100x100'" 
                                                 :alt="item.name"
                                                 class="w-full h-full object-center object-cover">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="ml-4 flex-1 flex flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>{{ item.name }}</h3>
                                                    <p class="ml-4">₹{{ item.price }}</p>
                                                </div>
                                            </div>
                                            <div class="flex-1 flex items-end justify-between text-sm">
                                                <!-- Quantity Selector -->
                                                <div class="flex items-center">
                                                    <label class="mr-2 text-gray-600">Qty:</label>
                                                    <select :value="item.quantity" 
                                                            @change="updateQuantity(item.id, $event)"
                                                            class="border rounded p-1 text-sm">
                                                        <option v-for="n in 10" :key="n" :value="n">{{ n }}</option>
                                                    </select>
                                                </div>

                                                <!-- Remove Button -->
                                                <div class="flex">
                                                    <button @click="removeItem(item.id)" 
                                                            class="font-medium text-red-600 hover:text-red-500">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6" v-if="cartItems.length > 0">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Subtotal</p>
                            <p>₹{{ cartData.total }}</p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                        <div class="mt-6">
                            <a href="/checkout" 
                               class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-yellow-400 hover:bg-yellow-500">
                                Checkout
                            </a>
                        </div>
                        <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                            <p>
                                or 
                                <button @click="closeCart" class="text-yellow-400 font-medium hover:text-yellow-500">
                                    Continue Shopping
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['close', 'update:cartCount']);

const cartData = reactive({
    items: [],
    total: 0,
    itemCount: 0
});

const cartItems = ref([]);
const loading = ref(false);

// Fetch cart items
const fetchCartItems = async () => {
    try {
        loading.value = true;
        const response = await axios.get('/cart/items');
        cartData.items = response.data.items;
        cartData.total = response.data.total;
        cartData.itemCount = response.data.itemCount;
        cartItems.value = response.data.items;
        
        // Emit cart count update to parent
        emit('update:cartCount', response.data.itemCount);
    } catch (error) {
        console.error('Error fetching cart items:', error);
    } finally {
        loading.value = false;
    }
};

// Remove item from cart
const removeItem = async (itemId) => {
    if (!confirm('Are you sure you want to remove this item?')) {
        return;
    }
    
    try {
        await axios.delete(`/cart/item/${itemId}`);
        await fetchCartItems(); // Refresh cart
    } catch (error) {
        console.error('Error removing item:', error);
        alert('Failed to remove item. Please try again.');
    }
};

// Update item quantity
const updateQuantity = async (itemId, event) => {
    const newQuantity = parseInt(event.target.value);
    
    try {
        await axios.put(`/cart/item/${itemId}`, {
            quantity: newQuantity
        });
        await fetchCartItems(); // Refresh cart
    } catch (error) {
        console.error('Error updating quantity:', error);
        alert('Failed to update quantity. Please try again.');
    }
};

// Close cart sidebar
const closeCart = () => {
    emit('close');
};

// Fetch cart items when sidebar opens
watch(() => props.isOpen, (newValue) => {
    if (newValue) {
        fetchCartItems();
    }
});

// Initial fetch on component mount
onMounted(() => {
    fetchCartItems();
});
</script>