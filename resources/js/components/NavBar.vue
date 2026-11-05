<template>
    <nav class="nav-bar">

    </nav>

</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import api from "../axios.js";


const loading = ref(false);
const error = ref(null);
const role = ref('');

onMounted(async () => {
    const res = await api.get('me');
    role.value = res.data.logged_in.account_type;
    console.log(role.value);
});
</script>
<style scoped>
</style>
