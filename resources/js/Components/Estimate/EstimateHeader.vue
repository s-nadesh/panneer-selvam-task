<script setup>

import InputText from 'primevue/inputtext';
import Select from 'primevue/select';
import DatePicker from 'primevue/datepicker';

defineProps({
    estimateno: String,
    customers: Array,
})

const customer = defineModel('customer')
const estimatedate = defineModel('estimatedate')
const status = defineModel('status')

// Options for your status dropdown
const statusOptions = [
    { label: 'Drafts', value: 'drafts' },
    { label: 'Finalised', value: 'finalised' }
];

</script>

<template>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-4">
            <label class="block text-sm font-medium mb-1">Estimate Number</label>
            <InputText :value="estimateno" readonly class="w-full" />
        </div>

        <div class="p-4">
            <label class="block text-sm font-medium mb-1">Customer</label>
            <Select 
                v-model="customer" 
                :options="customers" 
                optionLabel="title" 
                optionValue="id" 
                placeholder="Select a customer" 
                filter 
                class="w-full" 
            />
        </div>

        <div class="p-4">
            <label class="block text-sm font-medium mb-1">Estimate Date</label>
            <DatePicker v-model="estimatedate" class="w-full" showIcon fluid :showOnFocus="false" inputId="estimatedate"/>
        </div>

        <div class="p-4">
            <label class="block text-sm font-medium mb-1">Status</label>
            <Select 
                v-model="status" 
                :options="statusOptions" 
                optionLabel="label" 
                optionValue="value" 
                placeholder="Select a status" 
                class="w-full" 
            />
        </div>
    </div>
</template>