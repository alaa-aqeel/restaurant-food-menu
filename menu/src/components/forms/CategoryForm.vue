<template>
    <form @submit.prevent="submit" class="md:flex grid grid-cols-1 gap-2 items-end">
        
        <div class="w-full">
            <label class="text-sm font-bold px-1" for="email">
                الاسم
            </label>
            <input 
                name="name"  
                placeholder="اسم " 
                class="border border-gray-300 rounded-lg p-2 w-full mt-1" 
            />
            <span 
                v-for="(error, i) in errors.name" 
                :key="i" 
                class="text-red-600 px-1">
                {{ error }}
            </span>
        </div>

        <button 
            type="submit" 
            :disabled="isLoading"
            class="my-1 px-6 md:w-auto w-full py-1.5 text-blue-500 hover:text-white font-bold rounded-lg active:bg-blue-600 hover:bg-blue-500 hover:ring-0 ring-2  ring-blue-600"
            :class="{'bg-gray-300 text-white ring-0 hover:bg-gray-300 cursor-wait': isLoading}"
        >
            اضافة
        </button>
    </form>
</template>

<script setup>
import { defineProps, ref } from 'vue';
import { useStore } from 'vuex';


const store = useStore();
const errors = ref({})
const isLoading = ref(false)


const submit = ($e)=> {
    let formData = new FormData($e.target)
    errors.value = {}
    isLoading.value = true

    store.dispatch(`category/create`, formData)
        .then(()=>{

            $e.target.reset()
        }).catch(err=>{
            if (err.response.data) {
                alert(err.response.data.message)
                // errors.value = err.response.data.errors
            }   
        }).finally(()=> isLoading.value = false)
}

</script>

<style>

</style>