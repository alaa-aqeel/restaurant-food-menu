<template>
    <form @submit.prevent="submit">
        
        <div class="grid grid-cols-1 gap-2">
            <div class="py-4">
                <label class="text-sm font-bold px-1" for="email">
                    الاسم
                </label>
                <input name="name" v-model="user.name"  placeholder="اسم " class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.name" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
            <div >
                <label class="text-sm font-bold px-1" for="email">
                    اسم المستخدم ( username )
                </label>
                <input name="username" v-model="user.username"  placeholder="اسم المستخدام" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.username" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
            <div >
                <label class="text-sm font-bold px-1" for="email">
                    رقم الهاتف
                </label>
                <input name="phone" v-model="user.phone"  placeholder=" رقم الهاتف" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.phone" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
            <div >
                <label class="text-sm font-bold px-1" for="email">
                    كلمة المرور
                </label>
                <input name="password"  placeholder="كلمة المرور" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                <span v-for="(error, i) in errors.password" :key="i" class="text-red-600 px-1">
                    {{ error }}
                </span>
            </div>
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
    user: {
        type: Object,
        required: true
    }
})

const store = useStore();
const errors = ref({})
const isLoading = ref(false)


const submit = ($e)=> {
    let formData = new FormData($e.target)
    errors.value = {}
    isLoading.value = true
    store.dispatch(`auth/updateAccount`, Object.fromEntries(formData))
        .then(()=>{
            alert("تم حفظ البيانات")
        }).catch(err=>{
            if (err.response.data) {
                alert(err.response.data.message)
                errors.value = err.response.data.errors
            }   
        }).finally(()=> isLoading.value = false)
}

</script>

<style>

</style>