import { createRouter, createWebHistory } from "vue-router";
import Register from "../screens/Register.vue";
import Login from "../screens/Login.vue";
import Home from "../screens/Home.vue";
import CompanyRegister from "../screens/CompanyRegister.vue";
import CompanyLogin from "../screens/CompanyLogin.vue";
import UploadListing from "../screens/UploadListing.vue";
import { useCompanyAuthStore } from "../stores/CompanyAuthStore.js";
import ListingInfo from "../screens/ListingInfo.vue";

const routes = [
    { path: '/registerUser', component: Register, name: 'register user' },
    { path: '/loginUser', component: Login, name: 'login user' },
    { path: '/home', component: Home, name: 'home'},
    { path: '/registerCompany', component: CompanyRegister, name: 'register company' },
    { path: '/loginCompany', component: CompanyLogin, name: 'login company' },
    { path: '/uploadListing', component: UploadListing, name: 'upload listing', meta:{role: 'company'} },
    { path: '/listing/{listingId}', component: ListingInfo, name: 'listing info' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to) => {
    const companyStore = useCompanyAuthStore();
    await companyStore.getCurrentAccount();

    if(!to.meta.role) {
        return true;
    }
    if(to.meta.role === 'company' && companyStore.accountType === 'company') {
            return true;
    }
    else {
            await router.push({
                name: 'login company',
            });
        }

});
export default router;
