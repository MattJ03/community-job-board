import { createRouter, createWebHistory } from "vue-router";
import Register from "../screens/Register.vue";
import Login from "../screens/Login.vue";
import Home from "../screens/Home.vue";
import CompanyRegister from "../screens/CompanyRegister.vue";


const routes = [
    { path: '/registerUser', component: Register, name: 'register user' },
    { path: '/loginUser', component: Login, name: 'login user' },
    { path: '/home', component: Home, name: 'home'},
    { path: '/companyRegister', component: CompanyRegister, name: 'company register' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
