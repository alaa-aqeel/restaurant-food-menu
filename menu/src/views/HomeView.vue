<template>
    <div dir="rtl">
        <Header 
            :title="menu.title"
            :image="baseURL+menu.image"
            :address="menu.address"
            :work_time="menu.work_time"
            :phone_primary="menu.phone_primary"
            :phone_secondary="menu.phone_secondary"
        />
        <div class="categories py-6 px-12 flex gap-4 overflow-y-scroll ">
            <chip name="الكل" @click="getAll('')" /> 
            <chip 
                v-for="category in categories" 
                :key="category.id" 
                :name="category.name"
                @click="getAll(category.id)"
            /> 
        </div>

        <div class="container mx-auto  py-12 px-2">
            <div 
                v-if="!isLoading"
                class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 md:gap-4 gap-2">
                <Card 
                    v-for="f in food" :key="f.id" 
                    :name="f.name"
                    :image="`${baseURL}${f.image}`"
                    :price="f.price"
                    :description="f.description"
                />
                <div v-if="!food.length" 
                    class="w-full select-none py-10 font-bold text-gray-400 text-center"
                >لاتوجد بيانات </div>
            </div>
            <Loading v-else />
        </div>

        
        <!-- Messenger Chat Plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat Plugin code -->
        <div 
            id="fb-customer-chat" 
            class="fb-customerchat" 
            :page_id="store.state.restaurant.menu.facebook_page_id"
            attribution="biz_inbox"
        >
        </div>

    </div>
</template>

<script setup>
import { defineAsyncComponent, onMounted, computed, ref } from '@vue/runtime-core';
import { useStore } from 'vuex';
import { useRoute, useRouter } from 'vue-router'

const chip = defineAsyncComponent(()=> import('@/components/Chip.vue'))
const Header = defineAsyncComponent(()=> import('@/components/Header.vue'))
const Card = defineAsyncComponent(()=> import('@/components/Card.vue'))
const Loading = defineAsyncComponent(()=> import('@/components/Loading.vue'))

const store = useStore();
const route = useRoute();
const router = useRouter()
const isLoading = ref(false)



const createMessanger = () => {
     window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v14.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/ar_AR/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
}

const getAll =  (category) => {
    isLoading.value = true 
    return store.dispatch("restaurant/all", {slug: route.params.slug, category})
        .then(()=> {
            isLoading.value = false

            document.getElementsByTagName('title')
                    .item(0).innerText = store.state.restaurant.menu.title
    
            createMessanger()
        })
        .catch( ()=> {
            router.push({name: 'notfound'})
        })
}


onMounted(()=> {
    getAll('')


})

const baseURL = import.meta.env.VITE_API_DOWEN
const menu = computed(()=> store.getters["restaurant/menu"])
const categories = computed(()=> store.getters["restaurant/categories"])
const food = computed(()=> store.getters["restaurant/food"])

</script>

<style>

</style>