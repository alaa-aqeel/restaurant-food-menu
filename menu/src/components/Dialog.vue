<template>
    <div v-if="show" class="absolute top-0 left-0 w-full h-full">
        <div class="w-full min-h-screen flex items-center justify-center overflow-y-scroll">
            <div @click="$emit('close')" class="bg-gray-700 z-40 w-full min-h-screen absolute top-0 left-0  bg-opacity-30"></div>
            <div class="bg-white p-5 rounded-xl shadow xl:w-1/4 md:w-1/2 z-50">
                <div>
                    <button
                        @click="$emit('close')" 
                        class="text-yellow-800 border border-yellow-700 hover:bg-yellow-700 hover:text-white rounded-lg py-1.5 px-3">
                        X
                    </button> 
                </div>
                <slot :close="close" ></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineEmits, defineProps } from 'vue';

defineEmits(['close'])

defineProps({
    show: Boolean
})

</script>

<style>

</style>