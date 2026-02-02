<template>
    <div class="mb-6 space-y-3">
        <OfferItem 
            title="Cashback"
            description="Upto ₹4.00 cashback as Amazon Pay Balance when you..."
            offerCount="1"
        />
        
        <OfferItem 
            title="Bank Offer"
            description="Upto ₹1,500.00 discount on select Credit Cards, select..."
            offerCount="29"
        />
        
        <OfferItem 
            title="Partner Offers"
            description="Get GST invoice and save up to 18% on business purchases."
            offerCount="1"
        />
    </div>
</template>

<script setup>
import OfferItem from '@/Components/Product/OfferItem.vue';
</script>