<script setup>
import InputText from 'primevue/inputtext';
import Select from 'primevue/select';
import Button from 'primevue/button';

    defineProps({
        item : Object,
        products : Array,
        index : Number
    })

    const emit = defineEmits(['remove'])
</script>
<template>
    <tr>
        <td class="p-2">{{index+1}}</td>
        <td class="p-2">
            <Select v-model="item.product_id" :options="products" optionLabel="name" optionValue="id" placeholder="select a product" class="w-full"/>
        </td>
        <td class="p-2"><InputText v-model.number="item.qty" /></td>
        <td class="p-2"><InputText v-model.number="item.rate" /></td>
        <td class="p-2"><InputText v-model.number="item.discount" /></td>
        <td class="p-2">{{ ((item.qty || 0) * (item.rate || 0) - (item.discount || 0)).toFixed(2) }}</td>
        <td class="p-2"><Button label="delete" severity="danger" rounded text @click="emit('remove')" /></td>
    </tr>
</template>