<script setup>
import EstimateItemRow from './EstimaItemRow.vue';
import  Button from 'primevue/button'

defineProps({
    items:Array,
    products:Array
})

const emit = defineEmits(['add', 'remove'])
</script>
<template>
    <div class="overflow-x-auto p-4">
        <table class="table table-bordered mb-4">
        <thead class="border">
            <tr>
                <th class="p-3 text-left">S.No</th>
                <th class="p-3 text-left">Product</th>
                <th class="p-3 text-left">Qty</th>
                <th class="p-3 text-left">Rate</th>
                <th class="p-3 text-left">Discount</th>
                <th class="p-3 text-left">Amount</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>
            <tbody>
            <EstimateItemRow 
                v-for="(item, index) in items"
                :key="index"
                :index="index" 
                :item="item"
                :products="products"
                @remove="emit('remove', index)"
            />
        </tbody>
        </table>
        <Button label="+ Add Row" severity="info" @click="emit('add')" />
    </div>
</template>