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
                console.log(resp.data)
                return resp
            })  
    },
    profile({commit, state}) {
        state.isLoadingProfile = true
        return axios.get('account/profile')
            .then( (resp)=>{
                commit('login', resp.data)
                return resp
            } )
            .finally( ()=> state.isLoadingProfile = false)
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