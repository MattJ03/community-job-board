import { createRouter, createWebHistory } from "vue-router";
import Register from "../screens/Register.vue";
import Login from "../screens/Login.vue";


const routes = [
    { path: '/registerUser', component: Register, name: 'register user' },
    { path: '/loginUser', component: Login, name: 'login user' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
