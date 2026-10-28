import { createRouter, createWebHistory } from "vue-router";
import Register from "../screens/Register.vue";
import Login from "../screens/Login.vue";
import Home from "../screens/Home.vue";
import CompanyRegister from "../screens/CompanyRegister.vue";
import CompanyLogin from "../screens/CompanyLogin.vue";


const routes = [
    { path: '/registerUser', component: Register, name: 'register user' },
    { path: '/loginUser', component: Login, name: 'login user' },
    { path: '/home', component: Home, name: 'home'},
    { path: '/registerCompany', component: CompanyRegister, name: 'register company' },
    { path: '/loginCompany', component: CompanyLogin, name: 'login company '},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
