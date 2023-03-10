<template>
  <div>
    <div>
        <router-view></router-view>
    </div>
    <div class="w-full bg-gray-100  bottom-0 px-12 py-2 mt-6 text-end">
        <a href="https://etana-iq.com/" class="font-bold ">
          ايتانا للحلول البرمجية 
        </a>
    </div>
  </div>
</template>


<script setup>
import { defineAsyncComponent } from 'vue';
const Header = defineAsyncComponent(()=> import('@/components/Header.vue'))

</script>


