<template>
  <div>

    <div>
        <router-view></router-view>
    </div>

  </div>
</template>


<script setup>
import { defineAsyncComponent } from 'vue';
const Header = defineAsyncComponent(()=> import('@/components/Header.vue'))

</script>


