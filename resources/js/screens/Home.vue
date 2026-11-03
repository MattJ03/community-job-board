<template>
    <div class="container">
        <div class="top-of-screen">
        <div class="welcome-header">
            <h2>Jobs Across the county</h2>
            <span class="cjb-title">NI Companies</span>
        </div>
            <div class="search-wrapper">
                <input class="search-input"/>
                <img :src="searchImg" class="searchImg" alt="search"/>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import router from "../router/index.js";
import { useAuthStore } from "../stores/AuthStore.js";
import searchImg from '../assets/searchImg.png';


const loading = ref(false);
const error = ref('');
const search = ref('');
const authStore = useAuthStore();
const userName = ref(authStore.user.name);

console.log(userName.value);
</script>
<style scoped>
.container {
    flex-direction: column;
    width: 100%;

}
.top-of-screen {
    display: flex;
    align-items: center;
    flex-direction: column;

    background-color: #0F172A;
    width: 100%;
}
.welcome-header {
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: 40px;
    color: #f7fafc;
}
.cjb-title {
    font-size: 60px;
    font-weight: bolder;
}
.search-wrapper {
    display: flex;
    align-items: center;
    width: 35%;
    flex-direction: row;
}
.search-input {
    position: relative;
    height: 45px;
    padding-left: 24px;
    font-size: 14px;
    background-color: #f7fafc;
    border-radius: 30px;
    border: 1px solid #f7fafc;
    width: 100%;
}
.searchImg {
    position: absolute;
    height: 16px;
    width: 16px;
    padding-left: 6px;

}
</style>
