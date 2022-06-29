<template>
    <div class="px-20 flex items-center">
        <h1 class="font-bold text-3xl drop-shadow text-second">
            Menu
        </h1> 
        <div class="flex-1"></div>
        <div class="flex gap-3">
            <a 
                href="#" 
                class="hover:bg-blue-600 hover:text-white rounded-full border border-blue-600 text-blue-600"
            >
                <Icon  icon="fa:user" class="w-8 h-8 p-1.5 "   />
            </a>
        </div>
    </div>
</template>

<script setup>
import { Icon } from '@iconify/vue';

</script>

<style>

</style>