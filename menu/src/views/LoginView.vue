<template>
    <div class="py-6">
        <Navbar />
        <div class="flex flex-col items-center justify-center my-16">
            <h1 class="text-4xl font-medium font-mono py-5">Welcome Back</h1>

            <div>
                <template v-if="errorMessage">
                    <div class="bg-red-500 py-1.5 text-lg px-4 rounded text-white">
                        Invalid Data
                    </div>
                </template>

                <form class="flex flex-col" @submit.prevent="submit">
                    <div class="py-2">
                        <label class="text-sm font-bold px-1" for="email">Username</label>
                        <input name="username" v-model="loginData.username" placeholder="Enter username" id="email" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                    </div>
                    <div class="py-2 relative">
                        <label class="text-sm font-bold px-1" for="email">Password</label>
                        <input v-model="loginData.password" name="password" type="password" placeholder="Enter password" id="email" class="border border-gray-300 rounded-lg p-2 w-full mt-1" />
                    </div>
                    <button 
                        type="submit" 
                        :disabled="isLoading"
                        class="mt-4 w-full py-1.5 text-blue-500 hover:text-white font-bold rounded-lg active:bg-blue-600 hover:bg-blue-500 hover:ring-0 ring-2  ring-blue-600"
                        :class="{'bg-gray-300 text-white ring-0 hover:bg-gray-300 cursor-wait': isLoading}"
                    >
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Icon } from '@iconify/vue';
import { defineAsyncComponent, ref } from 'vue';
import { useStore } from 'vuex';
import route from "@/routes";
const Navbar = defineAsyncComponent(()=> import('@/components/Navbar.vue'))

const store = useStore();
const loginData = ref({
    username: '',
    password: ''
})
const errorMessage = ref('')
const isLoading = ref(false)

const submit = ($e) => {
    errorMessage.value = ''
    isLoading.value = true

    store.dispatch("auth/login", {
        username: loginData.value.username,
        password: loginData.value.password
    })
    .then(()=>{
        route.push({name: 'dashboard_profile'})
    }).catch(({response})=>{
        if (response) {
            errorMessage.value = response.data.message
        }
    }).finally(()=> isLoading.value = false)
}

</script>