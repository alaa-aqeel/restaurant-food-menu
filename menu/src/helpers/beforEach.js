import store from "@/store"


const loadUserProfile = (auth)=> {
    if (!auth.isLogin) {
        return store.dispatch('auth/profile')
            .then(()=>{
                store.dispatch("category/all")
            })
            .catch(()=> store.commit("auth/logout") )
    }
}

const setAccessToken = (accessToken)=> {
    if (accessToken) {
        store.commit("auth/setAccessToken", accessToken)
    }
}


export default  (to, from, next) => {
       
    let token = localStorage.getItem('access_token')
    
    if (token && !store.state.auth.isLogi) {
        setAccessToken(token)
        loadUserProfile(store.state.auth)
    }

    // auth 
    if (to.matched.some(record => record.meta.requireAuth)) {
        if (token == null) { 
            next({name: "login"})

        } else {

            // loadUserProfile(store.state.auth)
            next()
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (token != null) {
            next({name: "dashboard"})
        } else {
            next()
        }
    } else {
        next()
    }
}