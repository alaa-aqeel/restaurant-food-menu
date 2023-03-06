const routes = [
    {
        path: "",
        redirect: {name: "dashboard_profile"}
    },
    {
        path: "profile",
        name: "dashboard_profile",
        component: () => import("@/views/Dashboard/ProfileView.vue"),
        meta: {
            requireAuth: true
        },
        props: true
   },
   {
        path: "menu",
        name: "dashboard_menu",
        component: () => import("@/views/Dashboard/MenuView.vue"),
        meta: {
            requireAuth: true
        },
        props: true
   },
   {
        path: "category",
        name: "dashboard_category",
        component: () => import("@/views/Dashboard/CategoryView.vue"),
        meta: {
            requireAuth: true
        },
        props: true
    },
    {
        path: "food",
        name: "dashboard_food",
        component: () => import("@/views/Dashboard/FoodView.vue"),
        meta: {
            requireAuth: true
        },
        props: true
    },
    {
        path: "qr",
        name: "dashboard_qr",
        component: () => import("@/views/Dashboard/QRCodeView.vue"),
        meta: {
            requireAuth: true
        },
        props: true
    },
]


export default routes;