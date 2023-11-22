import { createRouter, createWebHistory } from "vue-router";
import phoneBook from "../components/phone-book/index.vue";
import phoneBookCreate from "../components/phone-book/create.vue";

const routes = [
    { path: '/', component: phoneBook },
    { path: '/phone-book/create', component: phoneBookCreate }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router
