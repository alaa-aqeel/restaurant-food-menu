<template>
  <div dir="rtl" class="relative md:flex md:flex-col gap-5 bg-back lg:py-6 p-2  border-2 hover:shadow-xl border-opacity-50 border-primary md:rounded-2xl rounded-lg ">

        <div>
            <div class="flex  lg:items-center lg:justify-center lg:flex-col gap-6 min-w-fit s">
                <img 
                    :src="image" 
                    class="lg:rounded-full rounded-lg lg:w-36 lg:h-36 w-24 h-24 object-cover object-center shadow-lg shadow-gray-400"
                >
                <div class=" lg:text-center">
                    <h1 class="md:text-xl break-words text-lg text-primary font-medium drop-shadow-lg ">
                        {{ name }}
                    </h1>
                    <h1 class="font-extrabold text-second mt-2">
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
            class="flex gap-2 items-center justify-end lg:px-2"
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