<template>
    <nav class="nav-bar">
        <div class="logo-wrapper">
            <img :src="logo" class="logo-img" @click="moveToHome()" alt="logo"/>
        </div>

        <div class="headings-wrapper">

        </div>
        <div class="buttons-wrapper">
            <span @click="moveToUpload()" v-if="accountType === 'company'" class="move-to-upload">Post job</span>
            <div class="users-account">
            <span class="my-account-btn" @click="showAccountActions = !showAccountActions"> {{ firstLetter }}</span>
                <div v-if="showAccountActions" class="user-account-actions">

                </div>
            </div>
            <span class="logout-user" @click="logout()" v-if="authStore.isLoggedIn">Log out</span>
        </div>
    </nav>
    <div class="modal-overlay" v-if="showAccountModal">

    </div>

</template>
<script setup>
import {ref, reactive, computed, onMounted, watch} from "vue";
import api from "../axios.js";
import logo from '../assets/logo.png';
import router from "../router/index.js";
import { useAuthStore } from "../stores/AuthStore.js";
import {storeToRefs} from "pinia";

const loading = ref(false);
const error = ref(null);
const accountType = ref('');
const authStore = useAuthStore();
const firstLetter = ref('');
const { name } = storeToRefs(authStore);
const showAccountActions = ref(false);
const showAccountModal = ref(false);

onMounted(async () => {
    const res = await api.get('me');
    accountType.value = res.data.account.account_type;
    authStore.name = res.data.account.name;
    firstLetter.value = authStore.name?.charAt('0').toUpperCase();
    console.log(firstLetter.value)
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
    height: 78px;
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
    align-items: center;
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
    padding-bottom: 0;
    border-bottom: 1px solid #f7fafc;
}
.logout-user:hover {
    color: #ccd0d5;
    border-bottom: 1px solid #ccd0d5;
    cursor: pointer;
}
.my-account-btn {

    color: #0F172A;
    padding: 10px 16px;
    border-radius: 60px;
    background-color: #f7fafc;
    font-size: 18px;
    font-weight: 400;
}
.my-account-btn:hover {
    background-color: #ccd0d5;
    cursor: pointer;
}
.users-account {
   position: relative;
    display: inline-flex;
}
.user-account-actions {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    z-index: 70;
    display: flex;
    flex-direction: column;
    width: 120px;
    height: 140px;
    border-radius: 12px;
    background-color: #0F172A;
    border: 1px solid #ccd0d5;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100vw;
    overflow: hidden;
    z-index: 65;
}
</style>
