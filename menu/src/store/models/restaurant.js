import axios from "@/plugins/axios"

const state = ()=>({
    food: [],
    categories: [],
    menu: {}
})

const mutations = {
    setData(state, data) {
        state.food = data.data ?? []
        state.categories = data.categories ?? []
        state.menu = data.menu ?? {}
    },
} 

const actions = {
    all({commit},  {slug, category}) {
        return axios.get(`restaurant/${slug}?category=${category}`)
            .then( (resp)=>{
                commit('setData', resp.data)
                return resp
            }) 
    },
}
const getters = {
    food(state) {
        return state.food
    },
    categories(state) {
        return state.categories
    },
    menu(state) {
        return state.menu
    }
}



export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}