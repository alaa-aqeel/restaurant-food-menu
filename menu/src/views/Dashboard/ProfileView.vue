<template>
  <div>
    <AccountForm :user="user" />
  </div>
</template>

<script setup>
import { defineProps, defineAsyncComponent, ref } from 'vue';
const AccountForm = defineAsyncComponent(()=> import('@/components/forms/AccountForm.vue'))

defineProps({
    user: {
        type: Object,
        required: true,
    },
})
</script>

<style>

</style>