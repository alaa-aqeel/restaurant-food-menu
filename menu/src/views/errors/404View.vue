<template>
  <div class="py-12 ">
    <Navbar />
    <div class="container mx-auto py-20">
        <div class="flex flex-col gap-2 items-center justify-center">
            <h1 class="text-9xl font-bold">
                404
            </h1>
            <h1 class="text-3xl font-medium font-mono flex gap-4 items-center uppercase">
                <Icon icon="heroicons-outline:emoji-sad" class="w-10 h-10" />
                <span>Not Found Page</span>
            </h1>
        </div>
    </div>
  </div>
</template>

<script setup>
import { defineAsyncComponent } from 'vue';
import { Icon } from '@iconify/vue';
const Navbar = defineAsyncComponent(()=> import('@/components/Navbar.vue'))

</script>

<style>

</style>