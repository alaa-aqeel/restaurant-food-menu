<template>
    <div class="block">
        <div class="rounded-lg border-2 hover:border-primary cursor-pointer select-none hover:shadow-lg hover:shadow-gray-300 px-3 py-1.5 bg-[#F2EAD3] flex items-center gap-2">
            <Icon :icon="icon" class="w-6 h-6" />
            <span class="font-bold text-lg">
                {{ name }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { Icon } from '@iconify/vue';

defineProps({
    name: {
        type: String,
        default: 'barger'
    },
    icon: {
        type: String,
        default: "fluent:food-16-filled"
    },
})
</script>

<style>

</style>