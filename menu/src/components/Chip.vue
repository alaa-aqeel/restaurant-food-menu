<template>
    <div class="block">
        <div 
            class="rounded-lg  cursor-pointer select-none 
            hover:shadow-lg hover:shadow-gray-300 px-3 py-1.5 bg-gray-100 flex items-center gap-2"

            :class="active ? `bg-primary text-white` : ''"
        >
            <Icon :icon="icon" class="w-6 h-6" />
            <span class="font-medium text-lg 0">
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
    active: Boolean
})
</script>

<style>

</style>