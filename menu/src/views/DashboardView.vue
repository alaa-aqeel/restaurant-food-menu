<template>
    <div class="py-6">
        <Navbar />
    </div>
</template>


<script setup>
import { defineAsyncComponent, ref } from 'vue';
import { useStore } from 'vuex';
import router from "@/routes";
const Navbar = defineAsyncComponent(()=> import('@/components/Navbar.vue'))


</script>
