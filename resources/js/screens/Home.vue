<template>
    <div class="container">
        <div class="top-of-screen">
        <div class="welcome-header">
            <h2>Jobs Across the county</h2>
            <span class="cjb-title">NI Companies</span>
        </div>
            <div class="search-row">
            <div class="search-job-wrapper">
                <input class="search-input" v-model="search" placeholder="search jobs"/>
                <img :src="searchImg" class="searchImg" alt="search"/>
                <img :src="x" @click="cancelSearch()" class="cancel-search-img" alt="x"/>
            </div>
            <div class="filter-job-wrapper">
                <img :src="location" class="locationImg" alt="location"/>
                <select class="counties-dropdown">
                    <option v-for="county in counties"> {{ county }} </option>
                </select>
            </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import router from "../router/index.js";
import { useAuthStore } from "../stores/AuthStore.js";
import searchImg from '../assets/searchImg.png';
import x from '../assets/x.png';
import location from '../assets/location.png';

const loading = ref(false);
const error = ref('');
const search = ref('');
const authStore = useAuthStore();
const userName = ref(authStore.user.name);
const counties = ref(['Fermanagh', 'Antrim', 'Tyrone', 'Londonderry', 'Armagh', 'Down']);

const cancelSearch = () => {
    search.value = '';
};

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
    align-items: center;
    flex-direction: column;
    justify-content: center;
    margin-bottom: 0;
    margin-top: 40px;
    color: #f7fafc;
}
.welcome-header h2 {
    margin-bottom: 0px;
}
.cjb-title {
    font-size: 60px;

    font-weight: bolder;
}
.search-row {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    flex-direction: row;
}
.search-job-wrapper {
    display: flex;
    position: relative;
    align-items: center;
    width: 20%;
    max-width: 500px;
    margin-top: 20px;
    flex-direction: row;
}
.search-input {
    position: relative;
    height: 45px;
    padding-left: 34px;
    font-size: 14px;
    background-color: #f7fafc;
    border-radius: 30px 0px 0px 30px;
    border: 1px solid #f7fafc;
    border-right: 1px solid #0F172A;
    width: 100%;
}
.searchImg {
    position: absolute;
    height: 16px;
    width: 16px;
    padding-left: 12px;
}
.cancel-search-img {
    position: absolute;
    right: 12px;
    height: 16px;
    width: 16px;
    padding-right: 12px;
    cursor: pointer;
}
.filter-job-wrapper {
    display: flex;
    position: relative;
    align-items: center;
    width: 20%;
    max-width: 500px;
    margin-top: 20px;
    flex-direction: row;
}
.counties-dropdown {

    display: flex;
    align-items: center;
    height: 45px;
    padding-left: 34px;
    font-size: 14px;
    background-color: #f7fafc;
    border: none;
    z-index: 1;
    border-radius: 0px 30px 30px 0px;
    width: 100%;
}
.locationImg {
    position: absolute;
    height: 16px;
    width: 16px;
    padding-left: 8px;
    z-index: 11;
}
</style>
