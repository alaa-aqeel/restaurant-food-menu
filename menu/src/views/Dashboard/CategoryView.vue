<template>
    <div class="container mx-auto ">
        <div  v-if="!isLoading" >
            <div class="w-full md:static absolute bottom-0 left-0 bg-white md:p-0 p-4">
                <CategoryForm />
            </div>
            <ul 
                class="flex flex-wrap gap-2 md:py-4"
            >   
                <li v-if="!categories.length" class="w-full select-none py-10 font-bold text-gray-400 text-center">
                    لاتوجد بيانات  
                </li>

                <li 
                    v-for="(category, i) in categories" 
                    :key="i"
                    class="rounded-lg border-2 cursor-pointer select-none  px-3 py-1.5 bg-[#F2EAD3] flex items-center gap-2"
                >    
                    {{ category.name }}
                    <button
                        @click="deleteCategory(category)"
                        class=""
                    >
                        <Icon 
                            v-if="isDeleteLoading[category.id]" 
                            icon="eos-icons:bubble-loading" 
                            class=" text-black"   
                        />
                        <span v-else class="border rounded-full border-red-600 px-1.5 text-red-600 hover:bg-red-600 hover:text-white ">
                            X
                        </span>
                    </button>
                </li>
            </ul>
        </div>
        <Loading v-else />
    </div>
</template>

<script setup>
import { Icon } from '@iconify/vue';
import { defineProps, computed, defineAsyncComponent, ref, onMounted } from 'vue';
import { useStore } from 'vuex';
const CategoryForm = defineAsyncComponent(()=> import('@/components/forms/CategoryForm.vue'))
const Loading = defineAsyncComponent(()=> import('@/components/Loading.vue'))

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
})

const store = useStore()
const isDeleteLoading = ref({})


const deleteCategory = (data) => {
    confirm(" ( كول والله ) انت متاكد من الحذف") 
    && (() => { 
        isDeleteLoading.value[data.id] = true 
        store.dispatch("category/delete", data) 
            .finally(() => isDeleteLoading.value[data.id] = false)
    })()      
}

const categories = computed(()=> store.state.category.data)
const isLoading = computed(()=> store.state.category.isLoadingData)


const getCategories = ()=> {
    if (!categories.value.length) {
        store.dispatch("category/all")
    }
}
onMounted(()=> getCategories())

</script>

<style>

</style>