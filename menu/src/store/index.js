import { createStore } from 'vuex'
import auth from "@/store/models/auth"
import category from "@/store/models/category"
import food from "@/store/models/food"
import restaurant from "@/store/models/restaurant"

// Create a new store instance.
const store = createStore({

    modules:{
        auth,
        category,
        food,
        restaurant
    }
})

export default store;