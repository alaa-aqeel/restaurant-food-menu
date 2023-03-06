<template>
  <div>
    <div class="text-gray-500 text-sm">
       تنتهي صلاحة حسابك بتاريخ 
      <strong class="mx-2">
        {{ user.expire_at}}
      </strong>
    </div>
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