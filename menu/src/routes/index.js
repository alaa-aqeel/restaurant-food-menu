import { createRouter, createWebHistory } from "vue-router";

import beforEach from "@/helpers/beforEach";
import dashboardRoutes from "@/routes/dashboard";
const routes = [
    { 
        path: "/:slug", 
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
        children: dashboardRoutes
    },
    { path: '/notfound', name: "notfound", component: ()=>import("@/views/errors/404View.vue"),  },
    { path: '/:pathMatch(.*)*', component: ()=>import("@/views/errors/404View.vue"),  },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(beforEach)

export default router;
