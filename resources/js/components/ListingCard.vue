<template>
    <div class="listing-card">
        <div class="top-listing">
            <div class="img-wrapper">
                <img :src="props.listing.company?.logo ? `/storage/${props.listing.company.logo}` : defaultLogo" alt="logo" class="company-logo"/>
            </div>
            <div class="title-company">
            <span class="listing-title"> {{ props.listing.title }} </span>
                <span class="listing-company"> {{ props.listing.company.name }}</span>
            </div>
        </div>
        <div class="location-info">
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
            <img :src="bluelocation" class="location-card-img" alt="location"/>
            <span class="work-from-answer"> {{ props.listing.location }}</span>
        </div>
        <div class="job-description-wrapper">
            <span> {{ props.listing.description }}</span>
        </div>
        <div class="pay-view-row">
            <span v-if="props.listing.salary" class="listing-pay">Salary: {{ payFormat(props.listing.salary) }}</span>
            <span v-if="props.listing.hourly" class="listing-pay"> {{ payFormat(props.listing.hourly) }} per hour</span>
            <span class="view-listing">View listing →</span>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, computed } from "vue";
import defaultLogo from '../assets/dafaultLogo.png';
import laptop from '../assets/laptop.png';
import building from '../assets/building.png';
import hybrid from '../assets/hybrid.png';
import bluelocation from '../assets/bluelocation.png';

const props = defineProps({
    listing: {
        type: Object,
        required: true,
    }
});

function payFormat(payment) {
    return Intl.NumberFormat('en-gb', {
    style: 'currency',
        currency: 'GBP',
    }).format(payment);
}
</script>
<style scoped>
.listing-card {
    display: flex;
   flex-direction: column;
    width: 100%;

    background-color: #0F172A;
    border: 1px solid #0F172A;
    transition: transform 0.3ms ease-in-out;
    border-radius: 10px;
    padding-bottom: 20px;
}
.listing-card:hover {
    cursor: pointer;
    border: 1px solid #ffffff;
    transform: scale(1.05);
}
.top-listing {
    display: flex;
    flex-direction: row;
    padding-left: 10px;
    padding-top: 10px;
}
.img-wrapper {
    overflow: hidden;
    height: 48px;
    width: 48px;
}
.company-logo {
    object-fit: cover;
    width: 100%;
}
.listing-title {
    font-weight: bolder;
    font-size: 18px;
    color: #f7fafc;
}
.title-company {
    display: flex;
    color: #f7fafc;
    flex-direction: column;
}
.listing-company {
    padding-top: 4px;
    font-size: 16px;
}
.laptop-img {
    height: 22px;
    width: 22px;
}
.building-img {
    height: 22px;
    width: 22px;
}
.location-card-img {
    height: 22px;
    width: 22px;
}
.location-info {
    display: flex;
    align-items: center;
    padding-top: 12px;
    flex-direction: row;
    width: 100%;
}
.work-from-location {
    display: flex;
    align-items: center;
    flex-direction: row;
    gap: 5px;

    padding-left: 12px;
    color: #f7fafc;
}
.work-from-answer {
    color: #f7fafc;
    padding-right: 6px;
}
.job-description-wrapper {
    display: flex;
    margin: auto;
    margin-top: 20px;
    border-radius: 14px;
    border: 1px solid #0000B3;
    width: 90%;
    height: 100px;
    background-color: #1A2540;
    padding-bottom: 18px;
}
.job-description-wrapper span {
    color: #A9B4C7;
    padding: 12px 20px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.pay-view-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding-left: 12px;
    padding-top: 18px;
    color: #f7fafc;
    font-size: 14px;
    font-weight: bold;
    padding-right: 12px;
}
.listing-pay {
    font-size: 18px;
}
.view-listing {
    font-weight: lighter;
    color: #F28A2E;
    font-size: 16px;
    border-bottom: 1px solid #F28A2E;
}
</style>
