import { createStore } from 'vuex'
import auth from "@/store/models/auth"
import category from "@/store/models/category"
import food from "@/store/models/food"

// Create a new store instance.
const store = createStore({

    modules:{
        auth,
        category,
        food
    }
})

export default store;