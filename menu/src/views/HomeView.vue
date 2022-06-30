<template>
    <div class="">
        <Header />
        <div class="categories py-6 flex gap-4 overflow-y-scroll ">
                <chip v-for="i in 20" :key="i" /> 
        </div>

        <div class="container mx-auto  py-12">
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 md:gap-4 gap-2">
                <Card v-for="i in 20" :key="i" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineAsyncComponent } from '@vue/runtime-core';

const chip = defineAsyncComponent(()=> import('@/components/Chip.vue'))
const Header = defineAsyncComponent(()=> import('@/components/Header.vue'))
const Card = defineAsyncComponent(()=> import('@/components/Card.vue'))
</script>

<style>

</style>