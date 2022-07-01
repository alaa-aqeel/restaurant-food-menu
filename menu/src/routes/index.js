import { createRouter, createWebHistory } from "vue-router";

import beforEach from "@/helpers/beforEach";

const routes = [
    { 
        path: "", 
        name: "home",
        component: () => import("@/views/HomeView.vue") 
    },
    { 
        path: "/login", 
        name: "login",
        component: () => import("@/views/LoginView.vue"),
        meta: {
            guest: true
        }
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: () => import("@/views/Dashboard/IndexView.vue"),
        meta: {
            requireAuth: true
        },
        children: [
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
            }
        ]
    },
    { path: '/:pathMatch(.*)*', component: ()=>import("@/views/errors/404View.vue"),  },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(beforEach)

export default router;
