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
        component: () => import("@/views/DashboardView.vue"),
        meta: {
            requireAuth: true
        }
    },
    { path: '/:pathMatch(.*)*', component: ()=>import("@/views/errors/404View.vue"),  },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(beforEach)

export default router;
