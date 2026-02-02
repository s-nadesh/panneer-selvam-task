<template>
    <div class="min-h-screen bg-gray-50">

        <!-- Cart Sidebar -->
        <CartSidebar 
            :isOpen="cartSidebarOpen" 
            @close="cartSidebarOpen = false"
            @update:cartCount="updateCartCount"
        />
        
        <!-- Success Toast Notification -->
        <div v-if="$page.props.flash.success" 
             class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-in">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ $page.props.flash.success }}
            </div>
        </div>

        <Header :cartCount="cartCount"  @openCart="cartSidebarOpen = true" />
        
        <Breadcrumb />
        
        <div class="container mx-auto p-4">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <!-- Product Header -->
                <ProductHeader 
                    :name="boards"
                    :rating="5"
                    :reviewCount="4"
                    :isAmazonChoice="true"
                    :monthlySales="324234"
                />

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Image -->
                    <ProductImage :imageUrl="dsd" :name="board" />

                    <!-- Right Column - Details -->
                    <div>
                        <!-- Price Section -->
                        <PriceSection 
                            :price="878"
                            :mrp="1200"
                            :discountedPrice="32"
                        />

                        <!-- Offers -->
                        <OffersSection />

                        <!-- Delivery Info -->
                        <DeliveryInfo />

                        <!-- Product Specifications -->
                        <ProductSpecs 
                            :brand="sss"
                            :color="black"
                            :type="brown"
                            :powerSource="ship"
                        />

                        <!-- Add to Cart Section -->
                        <AddToCartSection 
                            :productId="2"
                            :successMessage="sdfsd"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Header from '@/Components/Header.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import ProductHeader from '@/Components/Product/ProductHeader.vue';
import ProductImage from '@/Components/Product/ProductImage.vue';
import PriceSection from '@/Components/Product/PriceSection.vue';
import OffersSection from '@/Components/Product/OffersSection.vue';
import DeliveryInfo from '@/Components/Product/DeliveryInfo.vue';
import ProductSpecs from '@/Components/Product/ProductSpecs.vue';
import AddToCartSection from '@/Components/Product/AddToCartSection.vue';
import CartSidebar from '@/Components/Cart/CartSidebar.vue';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const boards = "boardsss"
const sss = "sss"
const black = "black"
const brown = "brown"
const ship = "ship"

const props = defineProps({
    product: Object,
    cartCount: Number
});

// Cart sidebar state
const cartSidebarOpen = ref(false);

// Update cart count when sidebar emits update
const cartCount = ref(props.cartCount);

const updateCartCount = (newCount) => {
    cartCount.value = newCount;
};



</script>