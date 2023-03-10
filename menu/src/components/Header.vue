<template>
  <div class="bg-back py-6"> 
    <div class="container mx-auto">
        <Navbar />
        <!-- <div class="py-5 w-full md:px-0 px-2" v-if="image">
            <img 
                v-lazy="{
                    src:image,
                    loading: 'https://i.picsum.photos/id/200/200/300.jpg?blur=10&grayscale&hmac=TBuA0MmYHfKvEvCRGYQ_b7zlDe-DQ0lgxfUOU_HMgO4', 
                    error: 'https://i.picsum.photos/id/200/200/300.jpg?blur=10&grayscale&hmac=TBuA0MmYHfKvEvCRGYQ_b7zlDe-DQ0lgxfUOU_HMgO4', 
                }" 
                class="rounded-xl object-cover object-center w-full max-h-[564px] shadow-lg shadow-gray-400"
            >
        </div> -->
        <div class="text-center md:pt-8 pt-4">
            <h1 class="text-primary pt-10 lg:text-7xl text-4xl font-semibold drop-shadow-xl">
                {{ title }}
            </h1>
            <div class="flex md:flex-row flex-col md:gap-20 gap-2 md:items-end items-start  justify-center md:p-10 px-6 py-8">
                <a v-if="work_time"  
                    class="flex items-start gap-2">
                    <Icon 
                        icon="clarity:clock-line" 
                        class="md:w-8 md:h-8 w-6 h-6 md:p-1 text-primary" />
                    <span class="text-second text-lg">
                        {{ work_time }}
                    </span>
                    
                </a>
                <a 
                    v-if="address" 
                    target="_blank" 
                    :href="getMapURL" 
                    class="flex items-start gap-2"
                >
                    <Icon 
                        icon="clarity:map-outline-badged" 
                        class="md:w-8 md:h-8 w-6 h-6  md:p-1 text-primary" />
                    <span class="text-second text-lg">
                        {{ address }}
                    </span>
                </a>
                <div class="flex">                    
                    <a :href="`tel:${phone_primary}`" class="flex items-center gap-2 " v-if="phone_primary">
                        <Icon 
                            icon="ph:phone" 
                            class="w-8 h-8 md:p-1 text-primary" />
                        
                        <span>
                            {{ phone_primary }}
                        </span>
                    </a>
                    <a :href="`tel:${phone_secondary}`" class="flex items-center gap-2 mx-2" v-if="phone_secondary">
                        -
                        <span>
                            {{ phone_secondary }}
                        </span>
                    </a>
                </div>
            </div>
            <div class="md:w-2/3 md:mx-auto md:px-0 px-6">
                <p class="text-gray-700">
                    {{ description }}
                </p>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
import { defineAsyncComponent, defineProps, computed } from 'vue';
import { Icon } from '@iconify/vue';
const Navbar = defineAsyncComponent(()=> import('@/components/Navbar.vue'))

const props = defineProps({
    title: {
        type: String,
        default: '...'
    },
    image: {
        type: String
    },
    address: {
        type: String,
        default: '....'
    },
    work_time: {
        type: String,
        default: '....'
    },
    mapURL: {
        type:String,
        default: "",
    },
    phone_secondary: String,
    phone_primary: String,
    description: String
})

// https://www.google.com/maps/search/?api=1&query=${address}
const getMapURL = computed(()=> {
    return props.mapURL 
        ? props.mapURL 
        : `https://www.google.com/maps/search/?api=1&query=${props.address}`
})

</script>

<style>

</style>