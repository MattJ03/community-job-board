<template>
    <NavBar></NavBar>
    <div class="container">
        <div class="listings-column">
            <ListingCard
                v-for="listing in listingStore.totalListings"
                :listing="listing"
                :key="listing.id"
                id="listing.id"
                />
        </div>
        <div class="listing-container">
            <div class="top-of-listing">
                <div class="img-wrapper">
                <img :src="listingStore.listing?.company?.logo ? `/storage/${listingStore.listing.company.logo}` : defaultLogo" alt="logo" class="logo-img"/>
                </div>
                <div class="listing-details-column">
                <div class="listing-details-upload-time">
                <div class="listing-location-details">
                <span class="company-name"> {{ currentListing.company?.name }} </span>
                    <span v-if="currentListing.work_from === 'on-site' || currentListing.work_from === 'hybrid'">: {{ currentListing.work_from }} job based in</span>
                    <span v-if="currentListing.work_from === 'remote'">: {{ currentListing.work_from}} role based in </span>
                    <span> {{ currentListing.location }}</span>
                </div>

                <div class="date-posted">
                    <img :src="clock" class="clock-img" alt="clock"/>
                    <span>{{ dayjs(currentListing.created_at).fromNow() }}</span>
                </div>
                </div>
                    <div class="listing-key-points">
                   <span class="industry-header"> {{ currentListing.industry }}</span>
                    </div>
            </div>
            </div>
            <h1 class="job-title"> {{ currentListing.title}}</h1>
            <div class="listing-main-info-wrapper">
                <div class="field">
                <span class="field-header">About the role</span>
                <span class="field-text"> {{ currentListing.description }}</span>
                </div>
                <div class="field">
                    <span class="field-header">A prospective candidate should</span>
                    <span class="field-text"> {{ currentListing.requirements }}</span>
                </div>
                <div class="field">
                    <span class="field-header">Minimum qualifications & experience</span>
                    <span class="field-text"> {{ currentListing.minimum_qualification}}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {ref, reactive, onMounted, watch} from 'vue';
import { useListingStore } from "../stores/ListingStore.js";
import { useRoute } from "vue-router";
import ListingCard from "../components/ListingCard.vue";
import NavBar from "../components/NavBar.vue";
import defaultLogo from '../assets/dafaultLogo.png';
import clock from '../assets/clock.png';
import dayjs from "dayjs";
import RelativeTime from 'dayjs/plugin/relativeTime.js';

dayjs.extend(RelativeTime);

const loading = ref(false);
const error = ref('');
const route = useRoute();
const listingStore = useListingStore();
const currentListingId = ref(route.params.listingId);
const currentListing = ref('');


const loadListing = async (id) => {
    if (id) {
        await listingStore.showListing(id);
        currentListing.value = listingStore.listing;
    }
};
watch(() => route.params.listingId,async (newId) => {
        await loadListing(newId);
    }
);


onMounted(async () => {
    await listingStore.getAllListings();
    await listingStore.showListing(currentListingId.value);
    currentListing.value = listingStore.listing;
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
    width: 25%;
    gap: 18px;
    margin-left: 30px;
    margin-top: 30px;
    overflow-y: scroll;
}
.listing-container {
    display: flex;
    flex-direction: column;
    width: 40%;
}
.top-of-listing {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-left: 40px;
    margin-top: 30px;
    width: 100%;
}
.img-wrapper {
    height: 90px;
    width: 90px;
    overflow: hidden;
}
.logo-img {
    object-fit: cover;
    width: 100%;
    border-radius: 10px;
}
.listing-details-column {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-left: 20px;

}
.listing-details-upload-time {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}
.listing-location-details {
    display: flex;
    flex-direction: row;
    align-items: center;
    font-size: 20px;
    gap: 6px;
}
.company-name {
    color: #0000B3;
    font-weight: 400;
    font-size: 20px;
}
.listing-key-points {
    display: flex;
    flex-direction: row;
    gap: 5px;
    margin-top: 12px;
    font-size: 15px;
}
.industry-header {
    padding: 6px 6px;
    background-color: #0000B3;
    border-radius: 10px;
    color: #f7fafc;
}
.date-posted {
    display: flex;
    align-items: center;
    gap: 6px;
}
.date-posted span {
    font-size: 14px;
}
.clock-img {
    height: 16px;
    width: 16px;
}
.job-title {
    margin-left: 40px;
    margin-top: 70px;
    font-size: 44px;
}
.listing-main-info-wrapper {
    display: flex;
    flex-direction: column;
    margin-left: 40px;
    margin-top: 30px;
    gap: 40px;
    width: 100%;
}
.field-header {
    font-size: 22px;
    font-weight: bold;
}
.field {
    display: flex;
    flex-direction: column;
    gap: 5px;
}
</style>
