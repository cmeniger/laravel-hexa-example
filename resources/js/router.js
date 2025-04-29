import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("@/pages/HomePage.vue"),
    },
    {
        path: "/users",
        name: "users",
        component: () => import("@/pages/UsersPage.vue"),
    },
    {
        path: "/about",
        name: "about",
        component: () => import("@/pages/AboutPage.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});