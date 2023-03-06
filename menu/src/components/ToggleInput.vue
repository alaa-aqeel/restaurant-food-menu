<template>
    <label 
        @click="$emit('update:checked', !checked)" 
        for="toggleThree" 
        class="flex items-center cursor-pointer select-none"
    >
        <div class="relative">
            <input  
                type="checkbox" 
                id="toggleThree" 
                class="sr-only"
                :checked="checked"
            >
            <div class="block bg-[#E5E7EB] w-14 h-8 rounded-full"></div>
            <div class="
                dot
                absolute
                top-1
                bg-white
                w-6
                h-6
                rounded-full
                transition
                flex
                items-center
                justify-center
            "
            :class="checked? 'right-1 bg-blue-500' : 'left-1 bg-gray-300'"

            ></div>
        </div>
    </label>
</template>


<script setup>

import { defineProps, defineEmits } from 'vue';
import { Icon } from '@iconify/vue';

defineProps({
    checked: {
        type: Boolean,
        default: false
    }
})



</script>