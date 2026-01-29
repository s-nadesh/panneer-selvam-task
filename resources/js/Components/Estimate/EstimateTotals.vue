<script setup>

import InputNumber from 'primevue/inputnumber'
    defineProps({
        amount:Number,
        qty:Number
    })
</script>

<template>
    <div class=" flex-column gap-3 p-4 bg-gray-100 border-round shadow-1" style="max-width: 400px; margin-left: auto;">

        <div class="flex m-2" style="justify-content:space-between; align-items:center">
            <label>qty</label>
            <InputNumber :modelValue="qty" readonly/>
        </div>
        <div class="flex m-2" style="justify-content:space-between; align-items:center">
            <label>amount</label>
            <InputNumber :modelValue="amount" readonly/>
        </div>
    </div>
</template>