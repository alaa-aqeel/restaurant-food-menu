import axios from "@/plugins/axios"

const state = ()=>({
    data: [],
    isLoadingData: false 
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
    all({commit, state}, data) {
        state.isLoadingData = true
        return axios.get(`menu/category`, data)
            .then( (resp)=>{
                commit('setData', resp.data.data)
                return resp
            })
            .finally(()=> state.isLoadingData = false)
    },
    create({commit}, data) {
        return axios.post(`menu/category`, data)
            .then( (resp)=>{
                commit('addData', resp.data.data)
                return resp
            }) 
    },
    update({commit}, data) {
        return axios.put(`menu/category/${data.id}`, data)
            .then( (resp)=>{
                commit('updateData', resp.data.data)
                return resp
            }) 
    },
    delete({commit}, data) {
        return axios.delete(`menu/category/${data.id}`)
            .then( (resp)=>{
                commit('removeData', data.id)
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