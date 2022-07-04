<template>
    <form @submit.prevent="submit">
        <div class="relative">
            <img 
                ref="image"
                :src="`http://127.0.0.1${menu.image}`" 
                class="rounded-xl object-cover bg-gray-400 object-center w-full h-[364px] shadow-lg shadow-gray-400" 
            />
            <div 
                @click="$refs.fileInput.click()"
                class="absolute top-0 left-0 h-[364px] rounded-xl active:bg-opacity-40  hover:bg-opacity-50 w-full hover:bg-gray-900 z-50"
            ></div>
            <input 
                accept="image/png, image/jpeg"
                @change="onSelectImage" 
                type="file" 
                ref="fileInput" 
                name="image" 
                hidden>
            <span v-for="(error, i) in errors.image" :key="i" class="text-red-600 py-4 px-1">
                {{ error }}
            </span>
        </div>
        <div class="py-4">
            <label class="text-sm font-bold px-1" for="email">
                الاسم
            </label>
            <input name="title" v-model="menu.title"  placeholder="اسم المطعم" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
            <span v-for="(error, i) in errors.title" :key="i" class="text-red-600 px-1">
                {{ error }}
            </span>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
            <div >
                <label class="text-sm font-bold px-1" for="email">
                    العنوان
                </label>
                <input name="address" v-model="menu.address"  placeholder="مثل: المحافظة .المنطقة . اقرب نقطه داله" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.address" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
            <div >
                <label class="text-sm font-bold px-1" for="email">
                    اوقات العمل
                </label>
                <input name="work_time" v-model="menu.work_time"  placeholder="مثل: من الساعه 10 صباح الى ساعه 10 ليل " class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.work_time" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
        </div>
        <div >
            <label class="text-sm font-bold px-1" for="email">
                وصف
            </label>
            <textarea name="description" v-model="menu.description"  
                placeholder="وصف المطعم" 
                class="border border-gray-300 rounded-lg p-2 w-full mt-1"
            ></textarea>
            <span v-for="(error, i) in errors.description" :key="i" class="text-red-600 px-1">
                {{ error }}
            </span>
        </div>

        <button 
            type="submit" 
            :disabled="isLoading"
            class="mt-4 px-6 md:w-auto w-full py-1.5 text-blue-500 hover:text-white font-bold rounded-lg active:bg-blue-600 hover:bg-blue-500 hover:ring-0 ring-2  ring-blue-600"
            :class="{'bg-gray-300 text-white ring-0 hover:bg-gray-300 cursor-wait': isLoading}"
        >
            حفظ
        </button>
    </form>
</template>

<script setup>
import { defineProps, ref } from 'vue';
import { useStore } from 'vuex';

const props = defineProps({
    menu: {
        type: Object,
        required: true,
        default: ()=>({})
    }
})

const store = useStore();
const baseURL = import.meta.env.VITE_APP_BASE_API_URL
const image = ref(null)
const errors = ref({})
const isLoading = ref(false)

const onSelectImage = ($e)=>{
    let file = $e.target.files[0]
    image.value.src = URL.createObjectURL(file)
}


const submit = ($e)=> {
    let formData = new FormData($e.target)
    errors.value = {}
    isLoading.value = true
    store.dispatch(`auth/updateMenu`, formData)
        .then(()=>{
            alert("تم حفظ البيانات")
        }).catch(err=>{
            if (err.response) {
                alert(err.response.data.message)
                errors.value = err.response.data.errors
            }   
        }).finally(()=> isLoading.value = false)
}

</script>

<style>

</style>