<template>
    <div class="container">
        <div class="listings-column">

        </div>
    </div>
</template>
<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useListingStore } from "../stores/ListingStore.js";


</script>
<style scoped>
.container {
    display: flex;
    flex-direction: row;
    width: 100%;
}
.listings-column {
    display: flex;
    flex-direction: column;

    width: 30%;
}

</style>
