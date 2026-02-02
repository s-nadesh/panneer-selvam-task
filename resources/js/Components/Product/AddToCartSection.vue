<template>
    <div class="border-t pt-6">
        <QuantitySelector v-model="quantity" />
        
        <div class="flex space-x-4 mb-4">
            <AddToCartButton 
                :productId="productId"
                :quantity="quantity"
                @added="handleAddedToCart"
            />
            
            <BuyNowButton 
                :productId="productId"
                :quantity="quantity"
            />
        </div>
        
        <GiftOptionsButton />
        
        <SuccessMessage v-if="successMessage" :message="successMessage" />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import QuantitySelector from '@/Components/Product/QuantitySelector.vue';
import AddToCartButton from '@/Components/Product/AddToCartButton.vue';
import BuyNowButton from '@/Components/Product/BuyNowButton.vue';
import GiftOptionsButton from '@/Components/Product/GiftOptionsButton.vue';
import SuccessMessage from '@/Components/SuccessMessage.vue';

const props = defineProps({
    productId: [String, Number],
    successMessage: String
});

const quantity = ref(1);

const handleAddedToCart = () => {
    // Emit event if needed
    console.log('Product added to cart');
};
</script>