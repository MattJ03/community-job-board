<template>
    <div class="container">
        <div class="top-of-screen">
        <div class="welcome-header">
            <h2>Jobs Across the county</h2>
            <span class="cjb-title"></span>
        </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import router from "../router/index.js";
import { useAuthStore } from "../stores/AuthStore.js";

const loading = ref(false);
const error = ref('');
const authStore = useAuthStore();
const userName = ref(authStore.user.name);

console.log(userName.value);
</script>
<style scoped>
.container {
    display: flex;
    flex-direction: column;

}
.top-of-screen {
    display: flex;
    justify-content: center;
    background-color: #0000B3;
}
.welcome-header {
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: 40px;
    color: #f7fafc;
}
.cjb-title {
    font-size: 28px;
}
</style>
