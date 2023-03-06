<template>
    <div>
        <div v-if="user.menu">
            <MenuForm :menu="user.menu"  />
        </div>
    </div>

</template>

<script setup>
import { defineProps, defineAsyncComponent, ref } from 'vue';
const MenuForm = defineAsyncComponent(()=> import('@/components/forms/MenuForm.vue'))

defineProps({
    user: {
        type: Object,
        required: true,
    },
})



</script>

<style>

</style>
