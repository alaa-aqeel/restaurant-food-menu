<template>
    <div class="md:px-16 px-2 flex items-center">
        <h1 class="font-bold text-3xl drop-shadow text-second">
            Menu
        </h1> 
        <div class="flex-1"></div>
        <div class="flex gap-3">
                <router-link 
                    v-if="!store.state.auth.accessToken"
                    to="login" 
                    title="login"
                    class="hover:bg-blue-600 hover:text-white rounded-full border border-blue-600 text-blue-600"
                >
                    <Icon  icon="fa:user" class="w-8 h-8 p-1.5 "   />
                </router-link>
                <div v-else class="flex gap-4">
                    <router-link 
                        to="dashboard"
                        title="dashboard"
                        :disabled="store.state.auth.isLoadingProfile"
                        :class='{"hover:bg-gray-100 hover:text-gray-500 border-gray-600 text-gray-600": store.state.auth.isLoadingProfile}'
                        class="hover:bg-blue-600 hover:text-white rounded-full border border-blue-600 text-blue-600"
                    >
                        <Icon v-if="store.state.auth.isLoadingProfile"  icon="eos-icons:bubble-loading" class="w-8 h-8 p-1.5 "   />
                        <div v-else class="flex items-center px-2">
                            <span >
                                {{ store.state.auth.user.username }}
                            </span>
                            <Icon  icon="fa:user" class="w-8 h-8 py-1.5 "   />
                        </div>
                    </router-link> 
                    <button
                        title="logout"
                        @click="logout"
                        v-if="store.state.auth.isLogin"
                        class="hover:bg-red-600 hover:text-white rounded-full  border border-red-600 text-red-600"
                    >
                        <Icon  icon="ant-design:logout-outlined" class="w-8 h-8 p-1.5 "   />
                    </button>
                </div>
                
        </div>
    </div>
</template>

<script setup>
import { Icon } from '@iconify/vue';
import { useStore } from 'vuex';
import route from '@/routes';

const store = useStore();

const logout = ()=>{
    store.commit("auth/logout")
    route.push({name: "login"})
} 

</script>

<style>

</style>