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
                </div>

                <div class="date-posted">
                    <img :src="clock" class="clock-img" alt="clock"/>
                    <span>{{ dayjs(currentListing.created_at).fromNow() }}</span>
                </div>
                </div>
                    <div class="listing-key-points">
                   <span class="industry-header"> {{ currentListing.industry }}</span>
                        <div class="industry-header" v-if="isRecentListing">
                            <img :src="lightening" class="new-listing-img" alt="lightening"/>
                        <span>New listing</span>
                        </div>
                        <span class="industry-header"> {{ currentListing.work_from }}</span>
                        <span class="industry-header"> {{ currentListing.location }}</span>

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
                <div class="field">
                <span class="field-header">About the company</span>
                <span class="field-text">Company description (ill do this later)</span>
                </div>
                <div class="field">
                   <div class="employee-count-square">
                       <span class="employee-count-text">{{ currentListing.company?.name }} employs</span>
                       <span class="employee-count-response"> {{ currentListing.company?.number_of_employees}}</span>
                   </div>
                </div>
            </div>

        </div>
        <div class="quick-info-container">
        <div class="rectangle-info-wrapper">
            <div v-if="currentListing.hourly" class="item-in-rectangle">
                <span class="rectangle-item-question">pay per hour</span>
                <span class="rectangle-item-answer"> {{ formatPay(currentListing.hourly) }}</span>
                <div class="horizontal-line"></div>
            </div>
            <div v-if="currentListing.salary" class="item-in-rectangle">
                <span class="rectangle-item-question">pay per year</span>
                <span class="rectangle-item-answer"> {{ formatPay(currentListing.salary) }}</span>
                <div class="horizontal-line"></div>
            </div>
            <div class="item-in-rectangle">
                <span class="rectangle-item-question">preferable years experience</span>
                <span class="rectangle-item-answer"> {{ currentListing.years_of_experience }}</span>
                <div class="horizontal-line"></div>
            </div>
            <div class="item-in-rectangle">
                <span class="rectangle-item-question">Views</span>
                <span class="rectangle-item-answer"> {{ currentListing.views }}</span>
                <div class="horizontal-line"></div>
            </div>
        </div>
        </div>
        <div class="listings-row-mobile">
        <ListingCard
            v-for="listing in listingStore.totalListings"
            :listing="listing"
            key="listing.id"
            />
        </div>
    </div>
</template>
<script setup>
import {ref, reactive, onMounted, watch, computed} from 'vue';
import { useListingStore } from "../stores/ListingStore.js";
import { useRoute } from "vue-router";
import ListingCard from "../components/ListingCard.vue";
import NavBar from "../components/NavBar.vue";
import defaultLogo from '../assets/dafaultLogo.png';
import clock from '../assets/clock.png';
import dayjs from "dayjs";
import RelativeTime from 'dayjs/plugin/relativeTime.js';
import lightening from '../assets/lightening.png';


dayjs.extend(RelativeTime);

const loading = ref(false);
const error = ref('');
const route = useRoute();
const listingStore = useListingStore();
const currentListingId = ref(route.params.listingId);
const currentListing = ref('');

const isRecentListing = computed(() => {
    if (!currentListing.value?.created_at) return false

    return dayjs().isBefore(dayjs(currentListing.value.created_at).add(1, 'day'))
})

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

function formatPay(pay) {
    return Intl.NumberFormat('en-gb', {
        style: "currency",
        currency: 'GBP'
    }).format(pay)
}
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
    height: 100dvh;
    width: 23%;
    overflow-y: auto;
    gap: 18px;
    margin-left: 80px;
    margin-top: 80px;

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
    margin-top: 80px;
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
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 12px;
    background-color: #0F172A;
    border-radius: 10px;
    color: #f7fafc;
}
.new-listing-img {
    height: 20px;
    width: 20px;
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
    padding-bottom: 40px;
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
.quick-info-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100dvh;
   width: 22%;
}
.rectangle-info-wrapper {
    display: flex;
    flex-direction: column;
    margin-left: 100px;
    align-items: center;
    padding-top: 12px;
    border-radius: 8px;
    background-color: #0F172A;
    height: auto;
    width: 300px;
    border: 1px solid #1a202c;


}
.item-in-rectangle {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 3px;
    padding: 0px 12px;

    width: 100%;
}
.rectangle-item-question {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #A9B4C7 ;
}
.rectangle-item-answer {
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 500;
    color: #f7fafc;
    width: 100%;

}
.horizontal-line {
    border: 1px solid #1a202c;
    border-radius: 10px;
    margin-top: 12px;
    width: 100%;
}
.employee-count-square {
    display: flex;
    flex-direction: column;
    gap: 14px;
    height: 100px;
    background-color: #0000B3;
    padding-left: 12px;
    padding-top: 10px;
    width: 50%;
    border-radius: 12px;
    border-top-right-radius: 40px;
    border-bottom-right-radius: 40px;
}
.employee-count-text {
    font-size: 16px;
    color: #f7fafc;
}
.employee-count-response {
    font-size: 40px;
    color: #f7fafc;
}
.listings-row-mobile {
    display: none;
}
@media(max-width: 900px) {
.container {
    flex-direction: column;
}

    .listings-column {
        display: none;
    }
    .listing-container {
        width: 100%;
    }
    .top-of-listing {
        margin-top: 50px;
        margin-left: 18px;
    }
    .job-title {
        margin-top: 30px;
    }
    .listing-details-column {
        margin-left: 6px;
    }
    .listing-details-upload-time {
        width: 90%;
    }
    .listing-main-info-wrapper {
        margin-left: 18px;
        width: 90%;
    }
    .quick-info-container {
        height: auto;
        width: 100%;
    }
    .rectangle-info-wrapper {
       width: 70%;
        margin: auto;
        margin-top: 30px;
    }
    .listings-row-mobile {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        gap: 8px;
        height: auto;
        overflow-x: auto;
        padding-left: 16px;
        box-sizing: border-box;
        margin-top: 30px;
        padding-bottom: 20px;
    }
}
</style>
