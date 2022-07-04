<template>
    <div class="container mx-auto">
        <div  v-if="!isLoading" >
            <CategoryForm :category="category" />
            <ul 
                
                class="flex flex-wrap gap-2 py-4"
            >   
                <li v-if="!categories.length" class="w-full select-none py-10 font-bold text-gray-400 text-center">

                    NOT DATA 
                </li>

                <li 
                    v-for="(category, i) in categories" 
                    :key="i"
                    class="rounded-lg border-2 cursor-pointer select-none  px-3 py-1.5 bg-[#F2EAD3] flex items-center gap-2"
                >    
                    {{ category.name }}
                    <button
                        @click="deleteCategory(category)"
                        class="border rounded-full border-red-600 px-1.5 text-red-600 hover:bg-red-600 hover:text-white "
                    >X</button>
                </li>
            </ul>
        </div>
        <Loading v-else />
    </div>
</template>

<script setup>
import { defineProps, computed, defineAsyncComponent, ref, onMounted } from 'vue';
import { useStore } from 'vuex';
const CategoryForm = defineAsyncComponent(()=> import('@/components/forms/CategoryForm.vue'))
const Loading = defineAsyncComponent(()=> import('@/components/Loading.vue'))


const store = useStore()
const category = ref({})


const deleteCategory = (data) => {
    confirm(" ( كول والله ) انت متاكد من الحذف") 
    && store.dispatch("category/delete", data)        
}

// onMounted(()=> getCategories())
const categories = computed(()=> store.state.category.data)
const isLoading = computed(()=> store.state.category.isLoadingData)

defineProps({
    user: {
        type: Object,
        required: true,
    },
})
</script>

<style>

</style>