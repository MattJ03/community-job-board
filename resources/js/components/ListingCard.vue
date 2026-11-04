<template>
    <div class="listing-card">
        <div class="top-listing">
            <div class="img-wrapper">
                <img :src="props.listing.logo || defaultLogo" alt="logo" class="company-logo"/>
            </div>
            <div class="title-company">
            <span class="listing-title"> {{ props.listing.title }} </span>
                <span class="listing-company"> {{ props.listing.company.name }}</span>
            </div>
        </div>
        <div class="work-from-location" v-if="props.listing.work_from === 'remote'">
            <img :src="laptop" class="laptop-img" alt="laptop"/>
            <span class="work-from-answer">Remote</span>
        </div>
        <div class="work-from-location" v-if="props.listing.work_from === 'on-site'">
            <img :src="building" class="building-img" alt="building"/>
            <span class="work-from-answer">On site</span>
        </div>
        <div class="work-from-location" v-if="props.listing.work_from === 'hybrid'">
            <img :src="hybrid" class="laptop-img" alt="hybrid"/>
            <span class="work-from-answer">Hybrid</span>
        </div>

    </div>
</template>
<script setup>
import { ref, reactive, computed } from "vue";
import defaultLogo from '../assets/dafaultLogo.png';
import laptop from '../assets/laptop.png';
import building from '../assets/building.png';
import hybrid from '../assets/hybrid.png';


const props = defineProps({
    listing: {
        type: Object,
        required: true,
    }
});
</script>
<style scoped>
.listing-card {
    display: flex;
   flex-direction: column;
    width: 100%;
    background-color: #0F172A;
    border: 1px solid #0F172A;
    border-radius: 10px;
}
.top-listing {
    display: flex;
    flex-direction: row;
    padding-left: 10px;
    padding-top: 10px;
}
.img-wrapper {
    overflow: hidden;
    height: 40px;
    width: 40px;
}
.company-logo {
    object-fit: cover;
}
.listing-title {
    font-weight: bolder;
    font-size: 16px;
    color: #f7fafc;
}
.title-company {
    display: flex;
    color: #f7fafc;
    flex-direction: column;
}
.listing-company {
    padding-top: 4px;
    font-size: 15px;
}
.laptop-img {
    height: 22px;
    width: 22px;
}
.building-img {
    height: 22px;
    width: 22px;
}
.work-from-location {
    display: flex;
    align-items: center;
    flex-direction: row;
    width: 100%;
    gap: 5px;
   padding-top: 10px;
    padding-left: 12px;
    color: #f7fafc;
}
.work-from-answer {
    color: #f7fafc;
}
</style>
