import { createRouter, createWebHistory } from "vue-router";
import Register from "../screens/Register.vue";


const routes = [
    { path: '/registerUser', component: Register, name: 'register user' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
