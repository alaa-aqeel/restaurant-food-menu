<template>
  <div>
    <div class="w-full top-0 px-2 fixed py-4 text-start ">
        <a href="https://etana-iq.com/" class="font-bold underline underline-offset-8 hover:text-blue-900 decoration-wavy hover:decoration-solid decoration-primary">
          ايتانا للحلول البرمجية 
        </a>
    </div>
    <div>
        <router-view></router-view>
    </div>

  </div>
</template>


<script setup>
import { defineAsyncComponent } from 'vue';
const Header = defineAsyncComponent(()=> import('@/components/Header.vue'))

</script>


