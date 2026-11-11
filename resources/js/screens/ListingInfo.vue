<template>
    <div class="container">
        <div class="listings-column">

        </div>
    </div>
</template>
<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useListingStore } from "../stores/ListingStore.js";
import { useRoute } from "vue-router";


const loading = ref(false);
const error = ref('');
const route = useRoute();
const listingStore = useListingStore();
const currentListingId = ref(route.params.listingId);
console.log(currentListingId.value);



onMounted(async () => {
    await listingStore.getAllListings();
    await listingStore.showListing(currentListingId.value);

})

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
