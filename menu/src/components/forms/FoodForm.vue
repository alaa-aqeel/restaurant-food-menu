<template>
    <form 
        @submit.prevent="submit" 
        class="grid grid-cols-1 items-start h-full w-full"
    >
        <div class="flex flex-col items-center justify-center">
            <img 
                ref="image"
                @click="$refs.fileInput.click()"
                :src="`${baseURL}${food.image}`" 
                class="rounded-full object-cover bg-gray-500 hover:bg-gray-700 object-center lg:w-36 lg:h-36 w-24 h-24 hover:cursor-pointer hover:p-2" 
            />
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
        <div class="grid grid-cols-1 px-4">
            <div>
                <label class="text-sm font-bold px-1" for="name">
                    الاسم
                </label>
                <input name="name" v-model="food.name"  placeholder="اسم الأكله" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.name" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
            <div >
                <label class="text-sm font-bold px-1" for="price">
                    السعر
                </label>
                <input name="price" type="number" v-model="food.price"  placeholder="السعر" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.price" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
            <div class="my-2">
                <label for="category" class="text-sm font-bold px-1">
                    التصنيف
                </label>
                <select 
                    id="category"
                    name="category_id"
                    v-model="food.category_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>----</option>
                    <option
                        v-for="category in categories"
                        :selected="food.category_id==category.id"
                        :key="category.id"
                        :value="category.id"
                        v-text="category.name"
                    ></option>
                </select>
            </div>
            <div >
                <label class="text-sm font-bold px-1" for="email">
                    وصف
                </label>
                <textarea name="description" v-model="food.description"  
                    placeholder="وصف ان وجد" 
                    class="border border-gray-300 rounded-lg p-2 w-full mt-1"
                ></textarea>
                <span v-for="(error, i) in errors.description" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
            <div class="flex items-center my-4 mx-2">
                <input 
                    id="is_available" 
                    :checked="food.is_available" 
                    name="is_available" 
                    type="checkbox" 
                    value="1" 
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2 "
                >
                <label for="is_available" class="mx-2 text-sm font-medium text-gray-900">
                    عرض الأكله
                </label>
            </div>
            <button 
                type="submit" 
                :disabled="isLoading"
                class="mt-4 px-6 md:w-auto w-full py-1.5 text-blue-500 hover:text-white font-bold rounded-lg active:bg-blue-600 hover:bg-blue-500 hover:ring-0 ring-2  ring-blue-600"
                :class="{'bg-gray-300 text-white ring-0 hover:bg-gray-300 cursor-wait': isLoading}"
            >
                حفظ
        </button>
        </div>


    </form>
</template>

<script setup>

import { defineProps, computed, ref } from 'vue';
import { useStore } from 'vuex';

const props = defineProps({
    menu: {
        type: Object,
        required: true,
        default: ()=>({})
    },
    food: {
        type: Object,
        required: true,
        default: ()=>({})
    }
})

const store = useStore();
const baseURL = import.meta.env.VITE_API_DOWEN
const image = ref(null)
const errors = ref({})
const isLoading = ref(false)
const categories = computed(()=> store.state.category.data)
const categorySelect = ref(null)

const onSelectImage = ($e)=>{
    let file = $e.target.files[0]
    image.value.src = URL.createObjectURL(file)
}


const submit = ($e)=> {
    let formData = new FormData($e.target)
    errors.value = {}

    if (props.food.category_id == null) {
        alert("يجب اختيار التصنيف")
        return
    }
    isLoading.value = true

    let req = props.food.id 
        ? store.dispatch(`food/update`, {category: props.food.category_id, id: props.food.id, data: formData})
        : store.dispatch(`food/create`, {category: props.food.category_id, data: formData})

    req
        .then(()=>{
            if (!props.food.id) {
                $e.target.reset()
                image.value.src = ""
            }
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