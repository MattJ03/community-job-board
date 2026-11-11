<template>
    <NavBar></NavBar>
    <div class="container">
        <div class="listings-column">
            <ListingCard
                v-for="listing in listingStore.totalListings"
                :listing="listing"
                id="listing.id"
                />
        </div>
        <div class="listing-container">
            <div class="top-of-listing">
                <div class="img-wrapper">
                <img :src="listingStore.listing?.company?.logo ? `/storage/${listingStore.listing.company.logo}` : defaultLogo" alt="logo" class="logo-img"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useListingStore } from "../stores/ListingStore.js";
import { useRoute } from "vue-router";
import ListingCard from "../components/ListingCard.vue";
import NavBar from "../components/NavBar.vue";
import defaultLogo from '../assets/dafaultLogo.png';
const loading = ref(false);
const error = ref('');
const route = useRoute();
const listingStore = useListingStore();
const currentListingId = ref(route.params.listingId);
console.log(currentListingId.value);



onMounted(async () => {
    await listingStore.getAllListings();
    await listingStore.showListing(currentListingId.value);

});

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
    gap: 18px;
    margin-left: 30px;
    margin-top: 30px;
    overflow-y: scroll;
}
.listing-container {
    display: flex;
    flex-direction: column;
}
.top-of-listing {
    display: flex;
    flex-direction: row;
    margin-left: 40px;
    margin-top: 30px;
}
.img-wrapper {
    height: 105px;
    width: 105px;
    overflow: hidden;
}
.logo-img {
    object-fit: cover;
    width: 100%;
    border-radius: 30px;
}
</style>
