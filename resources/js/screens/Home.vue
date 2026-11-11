<template>
    <NavBar></NavBar>
    <div class="container">
        <div class="top-of-screen">
        <div class="welcome-header">
            <h2>Jobs Across the country</h2>
            <span class="cjb-title">NI Jobs</span>
        </div>
            <div class="search-row">
            <div class="search-job-wrapper">
                <input class="search-input" v-model="search" placeholder="search jobs"/>
                <img :src="searchImg" class="searchImg" alt="search"/>
                <img :src="x" @click="cancelSearch()" class="cancel-search-img" alt="x"/>
            </div>
            <div class="filter-job-wrapper">
                <img :src="location" class="locationImg" alt="location"/>
                <select class="counties-dropdown" v-model="filterDetails.location">
                    <option class="location-value" v-for="county in counties"> {{ county }} </option>
                </select>
            </div>
                <button class="apply-filters-btn" @click="filterListings()">Show jobs</button>
            </div>
            <div class="filter-industries">
                    <span class="industry-bubble" v-for="industry in industries" :key="industry" @click="filterDetails.industry = industry"
                    :class="{ active: filterDetails.industry === industry}"
                    > {{ industry }} </span>
            </div>
        </div>
        <div class="listing-rows">
            <h2 v-if="!listingStore.totalListings" class="no-listing-text">Not find what your looking for? Try different filters.</h2>
            <ListingCard
                v-for="listing in listingStore.totalListings"
                :listing="listing"
                id="listing.id"

                />
        </div>
    </div>
</template>
<script setup>
import {ref, reactive, computed, onMounted, watch} from "vue";
import router from "../router/index.js";
import { useAuthStore } from "../stores/AuthStore.js";
import searchImg from '../assets/searchImg.png';
import x from '../assets/x.png';
import location from '../assets/location.png';
import { useListingStore } from "../stores/ListingStore.js";
import ListingCard from "../components/ListingCard.vue";
import api from "../axios.js";
import NavBar from "../components/NavBar.vue";


const loading = ref(false);
const error = ref('');
const search = ref('');
const authStore = useAuthStore();
const listingStore = useListingStore();
const userName = ref(authStore.user.name);
const counties = ref(['Fermanagh', 'Antrim', 'Tyrone', 'Londonderry', 'Armagh', 'Down']);
const industries = ref(['Software', 'Plumbing', 'Electrical', 'Mechanical', 'Gardening', 'Design', 'Moving', 'Transport', 'Roofing', 'Carpentry', 'Marketing', 'Business', 'Retail', 'Construction', 'Hospitality']);
const filterDetails = reactive({
    location: '',
    industry: '',
    search: '',
});
let page = ref(1);

watch(search, async (newSearch, oldSearch) => {
    if(search.value !== oldSearch) {
        setTimeout(async () => {

        await listingStore.getAllListings({
            search: search.value,
        });
        }, 400)
    }
});
const cancelSearch = async () => {
    search.value = '';
    filterDetails.location = '';
    filterDetails.industry = '';
    await listingStore.getAllListings();
};


onMounted(async () => {
  await listingStore.getAllListings();
    const res = await api.get('me');

});
const filterListings = async () => {
    loading.value = true;
    try {
    await listingStore.getAllListings({
        location: filterDetails.location || null,
        industry: filterDetails.industry || null,
        search: search.value || null,
    });
   } catch (err) {
        error.value = err.response?.data?.message || 'failed to get total listings';
    }
    finally {
        loading.value = false;
    }
 }

 const getMoreListings = async () => {

    if(loading.value) return;
    loading.value = true;
    try {
        await listingStore.getAllListings({
            location: filterDetails.location || null,
            industry: filterDetails.industry || null,
            search: search.value || null,
           page: page.value,
        });
        page.value++;
    } catch(err) {
        error.value = err.response?.data?.message || 'failed to get more listings';
    }
    finally {
        loading.value = false;
    }
 }


 window.onscroll = () => {
    if(window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        getMoreListings();
     }
 }

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
    margin-top: 20px;
    padding-bottom: 40px;
}
.search-job-wrapper {
    display: flex;
    position: relative;
    align-items: center;
    width: 20%;
    max-width: 500px;
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
.search-input:hover {
    border: 1px solid #E3963E;
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
    cursor: pointer;
}
.location-value {
    background-color: #0F172A;
    color: #f7fafc;
    border-radius: 14px;
    cursor: pointer;
}
.apply-filters-btn {
    height: 45px;
    margin-left: 12px;
    color: #f7fafc;
    font-size: 16px;
    border-radius: 30px;
    border: 1px solid #0000ff;
    background-color: #0000ff;
    padding: 8px 12px;

}
.apply-filters-btn:hover {
    background-color: #0000B3;
    cursor: pointer;
}
.locationImg {
    position: absolute;
    height: 16px;
    width: 16px;
    padding-left: 8px;
    z-index: 11;
}
.filter-industries {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 40%;
    margin-bottom: 40px;
}
.industry-bubble {
    color: #f7fafc;
    padding: 10px 12px;
    border-radius: 20px;
    border: 1px solid #f7fafc;
}
.industry-bubble:hover {
    background-color: #4a5568;
    cursor: pointer;
    transition: 0.2s;
}
.industry-bubble.active {
    background-color: #4a5568;
}
.listing-rows {
    display: grid;
    width: 99%;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 50px;
    margin-top: 30px;
    padding-left: 12px;
    padding-right: 12px;
}

@media (max-width: 900px) {
    .cjb-title {
        font-size: 40px;

    }
    .top-of-screen {
        width: 100%;
    }
    .search-row {
        width: 98%;
    }
    .search-job-wrapper {
        width: 40%;
    }
    .cancel-search-img {
        height: 14px;
        width: 14px;
    }
    .filter-job-wrapper {
        width: 40%;
    }
    .counties-dropdown {
        padding-left: 24px;
    }
    .cancel-search-img {
        padding-right: 0px;
    }
    .apply-filters-btn {
        margin-left: 8px;
    }
    .filter-industries {
        width: 98%;
    }
    .listing-rows {
        width: 96%;
        margin-left: auto;
        margin-right: auto;
        gap: 16px;
        padding-right: 0;
        padding-left: 0;
    }
}
</style>
