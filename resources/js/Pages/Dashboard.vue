<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import {ref} from 'vue'
import SaveButton from '@/Components/SaveButton.vue';
import Cards from '@/Components/Cards.vue';
import TextInput from '@/Components/TextInput.vue';
import Cancel from '@/Components/Cancel.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import {useToastStore} from '@/Stores/toast'

const name = ref('')
const message = ref('')
const toast = useToastStore()

const save = () => {
    toast.success('Saved using Pinia 🎉')
}

function handleSave(){
    message.value = `Enter text: ${name.value}`;
}
function cancel(){
    name.value = '';
    message.value = '';
}

defineProps({
    'username' : String
})


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard {{username}}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        You're logged in!
                        
                    </div>

                    <h1 class="text-lg font-bold">Task 1 </h1>
                    <Cards>
                        <TextInput v-model="name" />
                        <SaveButton @clicked="handleSave"/>
                        <Cancel @cancel="cancel"/>
                        <p>{{message}}</p>
                    </Cards>

                    <br/>

                    <h1 class="text-lg font-bold">Task 2 </h1>
                    <AppLayout>
                        Body Content
                    </AppLayout>
                    <br>
                    <h1 class="text-lg font-bold">Task 3 </h1>
                    <a :href="route('page.estimate')" class="bg-[#232F3E] text-white p-4 items-center align-items-center flex justify-center">estimate page</a>
                    <br>
                    <h1 class="text-lg font-bold">Task 4 </h1>
                    <a :href="route('product.index')" class="bg-[#232F3E] text-white p-4 items-center align-items-center flex justify-center">product page</a>
                    </br>
                    <h1 class="text-lg font-bold">Task 5 </h1>
                    <button @click = "save" class="bg-[#232F3E] text-white p-4 items-center align-items-center flex justify-center w-full">Trigger toast</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
