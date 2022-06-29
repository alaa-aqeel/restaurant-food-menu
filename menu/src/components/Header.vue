<template>
  <div class="bg-back py-6 "> 
    <div class="container mx-auto">
        <Navbar />
        <div class="py-5 w-full md:px-0 px-2">
            <img 
                src="./../assets/1-07720.jpg" 
                class="rounded-xl object-cover object-center w-full max-h-[564px] shadow-lg shadow-gray-400"
            >
        </div>
        <div class="text-center md:pt-8 pt-4">
            <h1 class="text-primary lg:text-6xl text-3xl font-semibold drop-shadow-xl">
                {{ title }}
            </h1>
            <div class="flex md:flex-row flex-col md:gap-20 gap-2 items-end justify-center md:p-10 px-6 py-8">
                <a class="flex items-center gap-2">
                    <span class="text-second text-lg">
                        {{ work_time }}
                    </span>
                    <Icon 
                        icon="clarity:clock-line" 
                        class="w-8 h-8 md:p-1 text-primary" />
                    
                </a>
                <a href="#" class="flex items-center gap-2">
                    <span class="text-second text-lg">
                        {{ address }}
                    </span>
                    <Icon 
                        icon="clarity:map-outline-badged" 
                        class="w-8 h-8  md:p-1 text-primary" />
                    
                </a>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
import { defineAsyncComponent, defineProps } from 'vue';
import { Icon } from '@iconify/vue';
const Navbar = defineAsyncComponent(()=> import('@/components/Navbar.vue'))

defineProps({
    title: {
        type: String,
        default: 'Etana For Fast Food'
    },
    image: {
        type: String
    },
    address: {
        type: String,
        default: 'العراق واسط الكوت حي الزهراء قرب تقاطع هكوري'
    },
    work_time: {
        type: String,
        default: 'من الساعه 12 ظهرا لغاية ال12 ليلا'
    }
})


</script>

<style>

</style>