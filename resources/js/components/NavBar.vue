<template>
    <nav class="nav-bar">
        <div class="logo-wrapper">
            <img :src="logo" class="logo-img" @click="moveToHome()" alt="logo"/>
        </div>

        <div class="headings-wrapper">

        </div>
        <div class="buttons-wrapper">
            <span @click="moveToUpload()" v-if="accountType === 'company'" class="move-to-upload">Post job</span>
            <span class="logout-user" @click="logout()" v-if="authStore.isLoggedIn">Log out</span>
        </div>
    </nav>

</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import api from "../axios.js";
import logo from '../assets/logo.png';
import router from "../router/index.js";
import { useAuthStore } from "../stores/AuthStore.js";

const loading = ref(false);
const error = ref(null);
const accountType = ref('');
const authStore = useAuthStore();
onMounted(async () => {
    const res = await api.get('me');
    accountType.value = res.data.account.account_type;
    console.log(accountType.value);
});

const moveToHome = async ()=> {
    await router.push({
        name: 'home',
    });
}

const moveToUpload = async () => {
    loading.value = true;
    await router.push({
        name: 'upload listing',
    });
}

const logout = async () => {
    loading.value = true;
    try {
        await authStore.logoutUser();
        await router.push({
            name: 'login user',
        });
    } catch (err) {
        error.value = err.response?.data?.message || 'failed to logout';
    } finally {
        loading.value = false;
    }
}

</script>
<style scoped>
.nav-bar {
    top: 0;
    display: flex;
    flex-direction: row;
    width: 100%;
    align-items: center;
    justify-content: space-between;
    height: 70px;
    background-color: #0F172A;
}
.logo-wrapper {
    height: 90%;
    overflow: hidden;
    padding-left: 18px;
}
.logo-img {
   height: 75px;
    cursor: pointer;
}
.headings-wrapper {
    display: flex;
}
.buttons-wrapper {
    display: flex;
    gap: 32px;
    flex-direction: row;
    justify-content: right;
    padding-right: 18px;
}
.move-to-upload {
    color: #f7fafc;
    border-bottom: 1px solid #f7fafc;
}
.move-to-upload:hover {
    cursor: pointer;
    color: #ccd0d5;
    border-bottom: 1px solid #ccd0d5;
}
.logout-user {
    color: #f7fafc;
    border-bottom: 1px solid #f7fafc;
}
.logout-user:hover {
    color: #ccd0d5;
    border-bottom: 1px solid #ccd0d5;
    cursor: pointer;
}
</style>
