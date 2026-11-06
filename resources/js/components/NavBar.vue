<template>
    <nav class="nav-bar">
        <div class="logo-wrapper">
            <img :src="logo" class="logo-img" alt="logo"/>
        </div>

        <div class="headings-wrapper">

        </div>
        <div class="buttons-wrapper">

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
    accountType.value = res.data.logged_in.account_type;
    console.log(accountType.value);
});
</script>
<style scoped>
.nav-bar {
    top: 0;
    display: flex;
    flex-direction: row;

    align-items: center;
    height: 70px;
    background-color: #f7fafc;
}
.logo-wrapper {
    height: 90%;
    overflow: hidden;
}
.logo-img {
   height: 75px;
}
.headings-wrapper {
    display: flex;
}
.buttons-wrapper {

}
</style>
