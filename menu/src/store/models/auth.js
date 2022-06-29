import axios from "@/plugins/axios"

const state = ()=>({
    isLogin: false,
    user: {},
})

const mutations = {

    setAccessToken(state, access_token) {
        localStorage.setItem("access_token", access_token)
        axios.defaults.headers.common["Authorization"] = "Bearer " + access_token
    },
    login(state, { data }) {
        state.isLogin = true
        state.user = data
    },
    logout(state) {
        state.isLogin = false
        state.user = {}
        localStorage.removeItem("access_token")
        axios.defaults.headers.common["Authorization"] = ''
    }
}


const actions = {
    login({commit}, formData) {
        return axios.post('auth/login', formData)
            .then( (resp)=>{
                commit('setAccessToken', resp.data.access_token)
                return resp
            })  
    },
}
const getters = {}



export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}