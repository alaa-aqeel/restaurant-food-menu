<template>
  <div dir="rtl" class="relative cursor-pointer md:flex md:flex-col bg-gray-50 shadow hover:shadow-xl  md:rounded-2xl rounded-lg ">
        <div>
            <div class="flex px-2 md:py-1 py-2 lg:items-center lg:justify-center lg:flex-col gap-6 min-w-fit ">
                <img 
                    :src="image" 
                    class="rounded-xl lg:w-full lg:h-40 h-24 w-32 object-cover object-center shadow shadow-yellow-100"
                >
                <div class="md:text-center lg:pb-2 md:p-0 p-0 pt-4">
                    <h1 class="md:text-2xl break-words text-lg text-gray-900 font-medium drop-shadow-xl ">
                        {{ name }}
                    </h1>
                    <h1 class="font-extrabold text-primary mt-2 text-2xl">
                        {{ priceFormat }}
                    </h1>
                </div>
            </div>
            <p v-if="description!=null" class="text-gray-400 font-light text-sm hover:break-words overflow-hidden text-clip p-2">
                {{ description }}
            </p>
        </div>

        <div 
            v-if="isManager"
            class="flex gap-2 p-4 items-center justify-end lg:px-2"
        >
            <button 
                @click="$emit('edit', id)" 
                class="lg:rounded-full rounded-lg text-blue-500 border border-blue-500 px-4 p-2 hover:text-white hover:bg-blue-500 "
            >
                <Icon icon="fa:edit" />
            </button>
            <button
                @click="$emit('delete', id)" 
                class="lg:rounded-full rounded-lg  text-red-500 border border-red-500 px-4 hover:text-white hover:bg-red-500 p-2 ">
                <Icon icon="fa:trash" />
            </button>
        </div>
        
        <div 
            v-if="loading == id"
            class="absolute z-50 top-0 left-0 w-full flex items-center justify-center bg-gray-900 bg-opacity-50 h-full md:rounded-2xl rounded-lg "
        >
            <Icon icon="eos-icons:bubble-loading" class="w-16 h-16 p-1.5 text-white"   />
        </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, computed } from 'vue';
import { Icon } from '@iconify/vue';
import * as currency  from "@/helpers/currency"

defineEmits(["edit", "delete"])
const props = defineProps({
    id: Number,
    image: {
        type: String,
        default: 'barger'
    },
    description: {
        type: String,
        default: ''
    },  
    name: {
        type: String,
        default: 'barger'
    },
    price: {
        type: String,
        default: "250"
    },
    isManager: {
        type: Boolean,
        default: false
    },
    isAvailable:{
        type: Boolean,
        default: true
    },
    loading: Boolean,
})

const priceFormat = computed(()=> {

    return currency.format(props.price);
})



</script>

<style>

</style>