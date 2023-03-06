import axios from "@/plugins/axios"

const state = ()=>({
    data: [],
})

const mutations = {
    setData(state, data) {
        state.data = data ?? []
    },
    addData(state, data) {
        state.data.push(data)
    },
    removeData(state, id){
        state.data = state.data.filter(row => row.id !== id)
    },
    updateData(state, data){
        state.data = state.data.map( it=> it.id === data.id ? data : it)
    }
} 

const actions = {
    all({commit},  {category}) {
        return axios.get(`menu/food`)
            .then( (resp)=>{
                commit('setData', resp.data.data)
                return resp
            }) 
    },
    create({commit},  {category, data}) {
        return axios.post(`menu/food`, data)
            .then( (resp)=>{
                commit('addData', resp.data.data)
                return resp
            }) 
    },
    update({commit}, {category, id, data}) {
        return axios.post(`menu/food/${id}?_method=put`, data)
            .then( (resp)=>{
                commit('updateData', resp.data.data)
                return resp
            }) 
    },
    delete({commit},  {category, id}) {
        return axios.delete(`menu/food/${id}`)
            .then( (resp)=>{
                commit('removeData', id)
                return resp
            }) 
    }
}
const getters = {}



export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}