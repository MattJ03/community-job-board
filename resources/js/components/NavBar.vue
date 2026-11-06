<template>
    <nav class="nav-bar">
        <div class="logo-wrapper">
            <img :src="logo" class="logo-img" alt="logo"/>
        </div>

        <div class="headings-wrapper">

        </div>
        <div class="buttons-wrapper">
            <span v-if="accountType === 'company'" class="move-to-upload">Post job</span>
        </div>
    </nav>

</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import api from "../axios.js";
import logo from '../assets/logo.png';

const loading = ref(false);
const error = ref(null);
const accountType = ref('');

onMounted(async () => {
    const res = await api.get('me');
    accountType.value = res.data.account.account_type;
    console.log(accountType.value);
});
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
}
.headings-wrapper {
    display: flex;
}
.buttons-wrapper {
    display: flex;
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
</style>
