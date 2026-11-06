import { createRouter, createWebHistory } from "vue-router";
import Register from "../screens/Register.vue";
import Login from "../screens/Login.vue";
import Home from "../screens/Home.vue";
import CompanyRegister from "../screens/CompanyRegister.vue";
import CompanyLogin from "../screens/CompanyLogin.vue";
import UploadListing from "../screens/UploadListing.vue";
import { useCompanyAuthStore } from "../stores/CompanyAuthStore.js";

const routes = [
    { path: '/registerUser', component: Register, name: 'register user' },
    { path: '/loginUser', component: Login, name: 'login user' },
    { path: '/home', component: Home, name: 'home'},
    { path: '/registerCompany', component: CompanyRegister, name: 'register company' },
    { path: '/loginCompany', component: CompanyLogin, name: 'login company' },
    { path: '/uploadListing', component: UploadListing, name: 'upload listing' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to) => {

})
export default router;
