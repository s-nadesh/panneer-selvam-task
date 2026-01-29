<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import EstimateHeader from '@/Components/Estimate/EstimateHeader.vue'
import EstimateItems from '@/Components/Estimate/EstimateItems.vue'
import EstimateTotals from '@/Components/Estimate/EstimateTotals.vue'
import TermsInput from  '@/Components/Estimate/TermsInput.vue'
import Button from 'primevue/button'


defineProps({
    customers: Array,
    estimatenumber: String,
    products: Array
})

const form = useForm({
    customers:'',
    estimateno:'Est-001',
    estimate_date : '',
    status : '',
    terms : '',
    items : [{product_id: '', qty: 0, reate:0, discount:0 }]
})

const rowAmount = (item) => (item.qty * item.rate) - item.discount
const totalQty = computed(()=>
                form.items.reduce((s, i) => s+i.qty, 0)
)
const subTotal = computed(()=>
                form.items.reduce((s, i) => s+rowAmount(i), 0)
)

const submit = ()=>{
form.post(route('estimate.store'))
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <a :href="route('dashboard')">back</a>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard 
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-4" >
                    <form @submit.prevent="submit">
                        <EstimateHeader 
                            v-model:customer ="form.customers" 
                            v-model:estimatedate="form.estimate_date"
                            v-model:status = "form.status" 
                            :estimateno=form.estimateno 
                            :customers="customers"
                        /> 

                        <EstimateItems
                            :items="form.items"
                            :products="products"
                            @add="form.items.push({ product_id:'', qty:0, rate:0, discount:0 })"
                            @remove="form.items.splice($event,1)"
                        />

                        <EstimateTotals 
                            :qty="totalQty"
                            :amount = "subTotal"
                        />
                        <TermsInput v-model="form.terms"/>
                        <br>
                        <Button label="Save" type="submit" severity="info" /> 
                    </form> 
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
