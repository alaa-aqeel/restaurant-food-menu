<template>
    <div>
        <Dialog :show="showForm" @close="onClose" >
            <FoodForm :food="currentFood" />
        </Dialog>
        
        <div class="w-full py-4">
            <div class="flex gap-2">
                <button
                    @click="showForm = true" 
                    class="text-yellow-800 border border-yellow-700 hover:bg-yellow-700 hover:text-white rounded-lg py-1.5 px-3">
                    إضافة أكل
                </button>
                <button
                    :disabled="isLoading"
                    @click="getFood" 
                    :class="{'cursor-wait': isLoading}"
                    class="text-blue-800 border border-blue-700 hover:bg-blue-700 hover:text-white rounded-lg py-1.5 px-3">
                    <Icon icon="fa:refresh" />
                </button>
            </div>

            <div 
                v-if="!isLoading"
                class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 md:gap-4 gap-2 py-6">
                <div v-if="!food.length" 
                    class="w-full select-none py-10 font-bold text-gray-400 text-center"
                >لاتوجد بيانات </div>
                <div v-for="f in food" :key="f.id">
                    <Card 
                        :image="`${baseURL}${f.image}`"
                        :id="f.id"
                        :name="f.name"
                        :price="f.price"
                        :description="f.description"
                        :is-manager="user.id"
                        @delete="deleteFood"
                        @edit="editFood(f)"
                        :loading="loadingDeleteFood"
                        :isAvailable="f.is_Available"
                    />
                </div>
            </div>
            <Loading v-else />
        </div>

    </div>
</template>


<script setup>
import {Icon} from "@iconify/vue"
import { defineProps, defineAsyncComponent, ref, onMounted, computed } from 'vue';
import { useStore } from 'vuex';

const FoodForm = defineAsyncComponent(()=> import('@/components/forms/FoodForm.vue'))
const Dialog = defineAsyncComponent(()=> import('@/components/Dialog.vue'))
const Card = defineAsyncComponent(()=> import('@/components/Card.vue'))
const Loading = defineAsyncComponent(()=> import('@/components/Loading.vue'))


defineProps({
    user: {
        type: Object,
        required: true,
    },
})

const baseURL = import.meta.env.VITE_API_DOWEN
const store = useStore();
const showForm = ref(false)
const loadingDeleteFood = ref(false)
const food = computed(()=> store.state.food.data)
const currentFood = ref({})
const isLoading = ref(false)


const getFood = ()=>{
    isLoading.value = true 
    store.dispatch('food/all', {category: 0})
        .finally(()=> isLoading.value = false)
}

const editFood = (food) => {
    showForm.value = true
    currentFood.value = food
}

const onClose = ()=>{
    showForm.value = false
    currentFood.value = {}
}

const deleteFood = (id) => {
    loadingDeleteFood.value = id
    store.dispatch('food/delete', {id: id, category: 0})
        .then( ()=> {
            alert("تم حذف الاكلة")
        })
        .finally(()=> loadingDeleteFood.value = id)
}

onMounted(()=>{
    getFood()
})


</script>


<style>

</style>