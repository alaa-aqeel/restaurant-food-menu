<template>
    <div class="py-4">
        <Navbar />
        <div class="container mx-auto py-12" dir="rtl">
            <template v-if="isLogin">
                <div >
                    <div class="mb-4 border-b border-gray-200 ">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" >
                            <li>
                                <router-link 
                                    :to="{name: 'dashboard_profile'}"
                                    active-class="text-blue-500 border-blue-500" 
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-blue-600 hover:border-blue-500 " 
                                >
                                    الملف الشخصي
                                </router-link>
                            </li>
                            <li>
                                <router-link 
                                    :to="{name: 'dashboard_menu'}"  
                                    active-class="text-indigo-600 border-indigo-600" 
                                    class="inline-block p-4  rounded-t-lg border-b-2 border-transparent hover:text-indigo-500 hover:border-indigo-500 "
                                >
                                    معلومات المطعم
                                </router-link>
                            </li>
                            <li>
                                <router-link 
                                    :to="{name: 'dashboard_category'}"
                                    active-class="text-orange-700 border-orange-700" 
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-orange-600 hover:border-orange-600 " 
                                >
                                    التنصيفات
                                </router-link>
                            </li>
                            <li>
                                <router-link  
                                    :to="{name: 'dashboard_food'}"
                                    active-class="text-yellow-700 border-yellow-700" 
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-yellow-600 hover:border-yellow-600 " 
                                >
                                    المأكولات
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="rounded-lg  px-2 py-4" >
                    <!-- <router-view :user="user"> -->
                        <router-view v-slot="{ Component }">
                            <transition 
                                enter-active-class="duration-300 scale-100"
                                enter-from-class="transform opacity-0 scale-75"
                                enter-to-class="opacity-100 scale-100"
                                leave-active-class="ease-in"
                                leave-from-class="opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-100"
                            >
                                <component :user="user" :is="Component" />
                            </transition>
                        </router-view>
                    <!-- </router-view> -->
                </div>

            </template>

            <Loading v-else />
        </div>
    </div>
</template>

<script setup>
import { Icon } from '@iconify/vue';
import { computed, defineAsyncComponent, ref } from 'vue';
import { useStore } from 'vuex';

// Components
const Navbar = defineAsyncComponent(()=> import('@/components/Navbar.vue'))
const Loading = defineAsyncComponent(()=> import('@/components/Loading.vue'))

const store = useStore();
const user = computed( ()=> store.state.auth.user );
const isLogin = computed( ()=> store.state.auth.isLogin );


</script>

<style >

</style>