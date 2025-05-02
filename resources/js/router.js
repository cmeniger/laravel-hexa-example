import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("@/pages/HomePage.vue"),
        meta: {
            breadCrumb() {
                return [
                    {text: 'Home'},
                ];
            },
        },
    },
    {
        path: "/users",
        name: "users",
        component: () => import("@/pages/UsersPage.vue"),
        meta: {
            breadCrumb() {
                return [
                    {text: 'Home', to: 'home'},
                    {text: 'Users'},
                ];
            },
        },
    },
    {
        path: "/users/:id",
        name: "user",
        component: () => import("@/pages/UserPage.vue"),
        meta: {
            breadCrumb(name) {
                return [
                    {text: 'Home', to: 'home'},
                    {text: 'Users', to: 'users'},
                    {text: name},
                ];
            },
        },
    },
    {
        path: "/about",
        name: "about",
        component: () => import("@/pages/AboutPage.vue"),
        meta: {
            breadCrumb() {
                return [
                    {text: 'Home', to: 'home'},
                    {text: 'About'},
                ];
            },
        },
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});