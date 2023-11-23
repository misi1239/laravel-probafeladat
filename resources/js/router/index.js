import { createRouter, createWebHistory } from "vue-router";
import phoneBook from "../components/phone-book/index.vue";
import phoneBookCreate from "../components/phone-book/create.vue";
import phoneBookUpdate from "../components/phone-book/update.vue";
import phoneBookDelete from "../components/phone-book/delete.vue";

const routes = [
    { path: '/', component: phoneBook },
    { path: '/phone-book/create', component: phoneBookCreate },
    { path: '/phone-book/update/:id', component: phoneBookUpdate },
    { path: '/phone-book/delete/:id', component: phoneBookDelete }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router
