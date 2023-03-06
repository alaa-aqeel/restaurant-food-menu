import axios from "@/plugins/axios"

const state = ()=>({
    isLogin: false,
    user: {},
    isLoadingProfile: false,
    accessToken: null
})

const mutations = {

    setAccessToken(state, access_token) {
        localStorage.setItem("access_token", access_token)
        axios.defaults.headers.common["Authorization"] = "Bearer " + access_token
        state.accessToken = access_token
    },
    login(state, data) {
        state.isLogin = true
        data.menu = data.menu ? data.menu : {}
        state.user = data
    },
    setUserMenu(state, data) {
        state.user.menu = data
    }, 
    setUser(state, data) {
        state.user = data
    },  
    logout(state) {
        state.isLogin = false
        state.user = {}
        localStorage.removeItem("access_token")
        axios.defaults.headers.common["Authorization"] = ''
        state.accessToken = null
    }
}


const actions = {
    login({commit}, formData) {
        return axios.post('login', formData)
            .then( (resp)=>{
                commit('setAccessToken', resp.data.token)
                commit('login', resp.data.data)
                return resp
            })  
    },
    profile({commit, state}) {
        state.isLoadingProfile = true
        return axios.get('account')
            .then( (resp)=>{
                commit('login', resp.data.data)
                return resp
            } )
            .finally( ()=> state.isLoadingProfile = false)
    },
    updateMenu({commit}, formData) {

        return axios.post(`menu/update`, formData)
            .then( (resp)=>{
                commit('setUserMenu', resp.data.data)
                return resp
            })  
    },
    updateAccount({commit}, formData) {
        return axios.put(`account/update`, formData)
            .then( (resp)=>{
                commit('setUser', resp.data.data)
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