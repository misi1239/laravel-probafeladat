import { createRouter, createWebHistory } from "vue-router";
import phoneBook from "../components/phone-book/index.vue";
import phoneBookCreate from "../components/phone-book/create.vue";
import phoneBookUpdate from "../components/phone-book/update.vue";

const routes = [
    { path: '/', component: phoneBook },
    { path: '/phone-book/create', component: phoneBookCreate },
    { path: '/phone-book/update/:id', component: phoneBookUpdate }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router
