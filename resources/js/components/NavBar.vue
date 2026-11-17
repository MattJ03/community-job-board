<template>
    <nav class="nav-bar">
        <div class="logo-wrapper">
            <img :src="logo" class="logo-img" @click="moveToHome()" alt="logo"/>
        </div>

        <div class="headings-wrapper">

        </div>
        <div class="buttons-wrapper">
            <span @click="moveToUpload()" v-if="accountType === 'company'" class="move-to-upload">Post job</span>
            <div class="users-account">
            <span class="my-account-btn" @click="showAccountActions = !showAccountActions"> {{ firstLetter }}</span>
                <div v-if="showAccountActions" class="user-account-actions">
                    <span @click="showPrefferedIndustries = true; showAccountActions = false;">Preferred industries</span>
                    <div class="horizontal-line"></div>
                </div>
            </div>
            <span class="logout-user" @click="logout()" v-if="authStore.isLoggedIn">Log out</span>
        </div>
    </nav>
    <div class="modal-overlay" v-if="showAccountModal || showPrefferedIndustries">
        <div class="show-preferred-industries-square">
            <div class="top-of-preferred">
                <h2>I'm interested in the following industries</h2>
                <div class="close-img-wrapper">
                <img :src="x" class="close-modal" @click="closePreferredIndustries()" alt="x"/>
                </div>
            </div>
            <div class="info-on-preferred">
                <div class="above-industries-options">
                <span class="select-industries-text">Select industries</span>
                <span class="select-industries-text"> {{ selectedIndustries.length }} of 5 selected </span>
                </div>
            </div>
            <div class="industries-options">
                <span class="industry-bubble" v-for="industry in industryStore.industries" @click="toggle(industry.id)"
                      :class="{ active: selectedIndustries.includes(industry.id) }"
                > {{ industry.name }}</span>
            </div>
            <div class="bottom-of-preferred-industries-square">
                <div class="submit-preferred-industries-btns">
                    <button class="clear-preferences-btn" @click="clearPreferredIndustries()">Clear</button>
                    <button class="submit-preferred-industries-btn" @click="storeUserPreferredIndustries()">Submit</button>
                </div>
            </div>
        </div>
    </div>

</template>
<script setup>
import {ref, reactive, computed, onMounted, watch} from "vue";
import api from "../axios.js";
import logo from '../assets/logo.png';
import router from "../router/index.js";
import { useAuthStore } from "../stores/AuthStore.js";
import { useIndustryStore } from "../stores/IndustryStore.js";
import {storeToRefs} from "pinia";
import x from '../assets/whiteX.png';
import tick from '../assets/tick.png';


const loading = ref(false);
const error = ref(null);
const accountType = ref('');
const authStore = useAuthStore();
const industryStore = useIndustryStore();
const firstLetter = ref('');
const { name } = storeToRefs(authStore);
const showAccountActions = ref(false);
const showAccountModal = ref(false);
const showPrefferedIndustries = ref(false);
const selectedIndustries = ref([]);

const toggle = (id) => {
    const i = selectedIndustries.value.indexOf(id);
    if(i !== -1) selectedIndustries.value.splice(i, 1);
    else if(selectedIndustries.value.length < 5) selectedIndustries.value.push(id);
}

onMounted(async () => {
    const res = await api.get('me');
    accountType.value = res.data.account.account_type;
    authStore.name = res.data.account.name;
    firstLetter.value = authStore.name?.charAt('0').toUpperCase();
    await industryStore.getAllIndustries();


});

const moveToHome = async ()=> {
    await router.push({
        name: 'home',
    });
}

const moveToUpload = async () => {
    loading.value = true;
    await router.push({
        name: 'upload listing',
    });
}

const logout = async () => {
    loading.value = true;
    try {
        await authStore.logoutUser();
        await router.push({
            name: 'login user',
        });
    } catch (err) {
        error.value = err.response?.data?.message || 'failed to logout';
    } finally {
        loading.value = false;
    }
}

const closePreferredIndustries = () => {
    selectedIndustries.value = [];
    showPrefferedIndustries.value = false;
}

const clearPreferredIndustries = () => {
    selectedIndustries.value = [];
}

const storeUserPreferredIndustries = async () => {
    loading.value = true;
    try {
        const res = await api.put('storePreferredIndustries', { industries: selectedIndustries.value });
        return true;
    } catch(err) {
        error.value = err.response?.data?.message || 'failed to put user preferred industries';
    } finally {
        loading.value = false;
    }
}

</script>
<style scoped>
.nav-bar {
    top: 0;
    display: flex;
    flex-direction: row;
    width: 100%;
    align-items: center;
    justify-content: space-between;
    height: 78px;
    background-color: #0F172A;
}
.logo-wrapper {
    height: 90%;
    overflow: hidden;
    padding-left: 18px;
}
.logo-img {
   height: 75px;
    cursor: pointer;
}
.headings-wrapper {
    display: flex;
}
.buttons-wrapper {
    display: flex;
    gap: 32px;
    flex-direction: row;
    justify-content: right;
    align-items: center;
    padding-right: 18px;
}
.move-to-upload {
    color: #f7fafc;
    border-bottom: 1px solid #f7fafc;
}
.move-to-upload:hover {
    cursor: pointer;
    color: #ccd0d5;
    border-bottom: 1px solid #ccd0d5;
}
.logout-user {
    color: #f7fafc;
    padding-bottom: 0;
    border-bottom: 1px solid #f7fafc;
}
.logout-user:hover {
    color: #ccd0d5;
    border-bottom: 1px solid #ccd0d5;
    cursor: pointer;
}
.my-account-btn {

    color: #0F172A;
    padding: 10px 16px;
    border-radius: 60px;
    background-color: #f7fafc;
    font-size: 18px;
    font-weight: 400;
}
.my-account-btn:hover {
    background-color: #ccd0d5;
    cursor: pointer;
}
.users-account {
   position: relative;
    display: inline-flex;
}
.user-account-actions {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    z-index: 70;
    display: flex;
    flex-direction: column;
    width: 160px;
    height: 140px;
    border-radius: 12px;
    background-color: #f7fafc;
    box-sizing: border-box;
    border: 1px solid #ccd0d5;
}
.user-account-actions span {
    padding-left: 6px;
    border-radius: 12px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    padding-top: 8px;
    font-size: 16px;
    padding-bottom: 3px;
}
.user-account-actions span:hover {
    background-color: #ccd0d5;
    cursor: pointer
}
.horizontal-line {
    border: 1px solid #0F172A;
    width: 100%;

}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100vw;
    overflow: hidden;
    z-index: 65;
}
.show-preferred-industries-square {
    display: flex;
    flex-direction: column;
    width: 45%;
    height: 500px;
    background-color: #f7fafc;

    border-radius: 12px;
}
.top-of-preferred {
    display: flex;
    flex-direction: row;
    justify-content: right;
    width: 100%;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;

    background-color: #0F172A;
    height: 10%;
}
.top-of-preferred h2 {
    display: flex;
    margin: auto;
    color: #f7fafc;
}
.close-img-wrapper {
    display: flex;
    align-items: center;
    padding-right: 4px;

}
.close-modal {
    height: 20px;
    padding: 10px;
    border-radius: 30px;
}
.close-modal:hover {
    cursor: pointer;
    background-color: #A9B4C7;
}
.info-on-preferred {
    display: flex;
    flex-direction: row;
    height: 50px;
    width: 100%;

}
.above-industries-options {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 20px;
    font-size: 16px;
}
.select-industries-text {
    color: #A9B4C7;
}
.industries-options {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 4px;
    margin-top: 30px;
    width: 80%;
    flex-wrap: wrap;
}
.industry-bubble {
    color: #f7fafc;
    padding: 10px 12px;
    border-radius: 20px;
    background-color: #0F172A;
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
.bottom-of-preferred-industries-square {
    display: flex;
    flex-direction: row;
    height: 10%;
    width: 100%;
    background-color: #0F172A;
    margin-bottom: 0;
    margin-top: auto;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    padding-top: 8px;
    padding-bottom: 8px
}
.submit-preferred-industries-btns {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: row;
    width: 50%;
    margin-left: auto;
}
.clear-preferences-btn {
    height: 90%;
    width: 85px;
    background-color: #f7fafc;
    color: #000000;
    border-radius: 12px;
    font-size: 15px;
    border: 1px solid #f7fafc;
    font-weight: 400;
}
.clear-preferences-btn:hover {
    background-color: #A9B4C7;
    cursor: pointer;
    border: none;
}
.submit-preferred-industries-btn {
    height: 90%;
    width: 85px;
    background-color: #0000B3;
    color: #f7fafc;
    font-size: 15px;
    border-radius: 12px;
    border: 1px solid #0000B3;
    font-weight: 400;
    margin-right: 20px;
}
.submit-preferred-industries-btn:hover {
    background-color: #1A2540;
    cursor: pointer;
}
</style>
