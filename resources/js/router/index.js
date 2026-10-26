import { createRouter, createWebHistory } from "vue-router";
import Register from "../screens/Register.vue";
import Login from "../screens/Login.vue";
import Home from "../screens/Home.vue";


const routes = [
    { path: '/registerUser', component: Register, name: 'register user' },
    { path: '/loginUser', component: Login, name: 'login user' },
    { path: '/home', component: Home, name: 'home'},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
