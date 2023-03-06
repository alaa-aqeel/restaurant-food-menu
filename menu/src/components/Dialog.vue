<template>
    <div v-if="show" class="absolute top-0 left-0 w-full h-full min-h-screen z-50">
        <div class="w-full flex items-center justify-center min-h-screen md:py-2 overflow-y-scroll bg-gray-700 bg-opacity-30">
            <div @click="$emit('close')" class="z-50 w-full min-h-screen absolute top-0 left-0  bg-opacity-30"></div>
            <div class="bg-white md:p-5 md:rounded-lg px-2 py-5  shadow xl:w-1/4 md:w-1/2 w-full md:min-h-full min-h-screen    z-50">
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