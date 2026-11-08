<template>
    <NavBar></NavBar>
    <div class="container">
        <div class="form-card">
            <div class="title-company">
                <div class="field">
                    <span class="field-text">Role title</span>
                    <input class="field-input-title" v-model="form.title"/>
                </div>
                <div class="field">
                    <span class="field-text">Company Name</span>
                    <input class="field-input-title" v-model="form.companyName"/>
                </div>
            </div>
            <div class="industry-field">
                <span class="field-text">Industry</span>
            <div class="industry-selection">
                <span v-for="industry in industries" :key="industry" class="industry-bubble" @click="form.industry = industry"
                :class="{ active: form.industry === industry }"
                > {{ industry }}</span>
            </div>
            </div>
            <div class="horizontal-line"></div>
            <div class="location-work-from-topic">
            <span class="field-text-header">Where and How</span>
            <div class="location-row">
                <div class="field">
                    <span class="field-text">Location</span>
                    <select class="field-dropdown-location" v-model="form.location">
                        <optgroup label="Towns & Cities">
                        <option v-for="location in locations"> {{ location }}</option>
                        </optgroup>
                        <optgroup label="Or just select a county">
                            <option v-for="county in counties"> {{ county }}</option>
                        </optgroup>
                    </select>
                </div>
                <div class="field">
                    <span class="field-text">Work from</span>
                    <div class="work-from-wrapper">
                        <button class="work-type-button" @click="form.work_from = 'remote'"
                        :class="{ active: form.work_from === 'remote'}"
                        >Remote</button>
                        <button class="work-type-button" @click="form.work_from = 'hybrid'"
                        :class="{ active: form.work_from === 'hybrid'}"
                        >Hybrid</button>
                        <button class="work-type-button" @click="form.work_from = 'off-site'"
                        :class="{ active: form.work_from === 'off-site'}"
                        >On-site</button>
                    </div>
                </div>
            </div>
                <div class="horizontal-line"></div>
            </div>
            <div class="payment-wrapper">
                <span class="field-text-header">Pay</span>
            <div class="pay-row">
                <div class="field">
                    <span class="field-text">Payment type</span>
                    <div class="hour-salary-wrapper">
                        <button class="hour-salary-btn" @click="isSalary = false; form.salary = null;"
                        :class="{ active: !isSalary}"
                        >Hourly role</button>
                        <button class="hour-salary-btn" @click="isSalary = true; form.hourly = null;"
                        :class="{ active: isSalary}"
                        >Salary role</button>
                    </div>
                </div>
                <div class="field" v-if="!isSalary">
                    <span class="field-text">Approximate pay (per hour)</span>
                    <input type="number" class="field-input-title"/>
                </div>
                <div class="field" v-if="isSalary">
                    <span class="field-text">Approximate salary</span>
                    <input type="number" class="field-input-title"/>
                </div>
            </div>
            </div>
            <div class="horizontal-line"></div>
            <div class="job-description-row">
                <span class="field-text-header">Description</span>
                <span class="field-text">Job description</span>
                <textarea class="description-field" maxlength="2000"/>
            </div>
            <div class="contact-wrapper">
            <span class="field-text-header">Contact info</span>
            <div class="contact-row">
                <div class="contact-list">
                    <div class="contact-field">
                        <span class="field-text">Email</span>
                    <input class="field-input-title"/>
                    </div>
                    <div class="contact-field">
                        <span class="field-text">Company number</span>
                    <input class="field-input-title"/>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import NavBar from "../components/NavBar.vue";

const loading = ref(false);
const error = ref('');

const industries = ref(['Software', 'Plumbing', 'Electrical', 'Mechanical', 'Gardening', 'Design', 'Moving', 'Transport', 'Roofing', 'Carpentry', 'Marketing', 'Business', 'Retail', 'Construction', 'Hospitality']);
const locations = ref(['Belfast', 'Londonderry', 'Lisburn', 'Newry', 'Armagh', 'Bangor', 'Craigavon', 'Ballymena', 'Omagh', 'Enniskillen', 'Coleraine', 'Newtownards', 'Antrim (town)', ])
const counties = ref(['Fermanagh', 'Antrim', 'Tyrone', 'Londonderry', 'Armagh', 'Down']);
const form = reactive({
    title: '',
    companyName: '',
    industry: '',
    location: '',
    work_from: '',
    hourly: null,
    salary: null,
});

const isSalary = ref(true);
</script>
<style scoped>
.container {
    display: flex;
    width: 100%;
}
.form-card {
    display: flex;
    flex-direction: column;
    height: auto;
    justify-content: center;
    margin: auto;
    margin-top: 80px;
    background-color: #0F172A;
    gap: 30px;
    width: 45%;
    padding-left: 32px;
    padding-right: 32px;
    border-radius: 10px;
}
.title-company {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 30px;
    width: 100%;
}
.field {
    display: flex;
    flex-direction: column;
    font-size: 18px;
    color: #f7fafc;
    width: 45%;
}
.field-text {
    color: #f7fafc;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 8px;
}
.field-input-title {
    background-color: #1a2542;
    height: 45px;
    width: 100%;
    border-radius: 14px;
    border: 1px solid #0000B3;
    color: #f7fafc;
    font-size: 16px;
    padding-left: 8px;
}
.industry-selection {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    gap: 12px;
}
.industry-bubble {
    color: #f7fafc;
    padding: 12px 14px;
    border-radius: 20px;
    font-size: 16px;
    border: 1px solid #f7fafc;
}
.industry-bubble:hover {
    background-color: #4a5568;
    cursor: pointer;
    transition: 0.7s;
}
.industry-bubble.active {
    background-color: #f7fafc;
    transition: 0.7s;
    color: #1c1e21;
}
.industry-field {
    display: flex;
    flex-direction: column;
    width: 100%;
    color: #f7fafc;
    font-size: 16px;
}
.field-text-header {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #f7fafc;
}
.location-work-from-topic {
    display: flex;
    flex-direction: column;

}
.location-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    color: #f7fafc;
    font-size: 16px;
}
.field-dropdown-location {
    background-color: #1a2542;
    height: 45px;
    width: 100%;
    border-radius: 14px;
    border: 1px solid #0000B3;
    color: #f7fafc;
    font-size: 16px;
    padding-left: 8px;
}
.work-from-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 45px;
    width: 100%;
    background-color: #1a2542;
    border: 1px solid #0000B3;
    border-radius: 30px;
    padding-left: 6px;
    padding-right: 6px;
}
.work-type-button {
    font-size: 16px;
    background-color: transparent;
    width: 100%;
    color: #f7fafc;
    height: 85%;
    border: none;
    border-radius: 999px;
    padding-left: 10px;
}
.work-type-button:hover {
    color: #1c1e21;
    background-color: #f7fafc;
    cursor: pointer;
}
.work-type-button.active {
    color: #1c1e21;
    background-color: #f7fafc;
    cursor: pointer;
}
.horizontal-line {
    border: 1px solid #1a202c;
    margin-top: 10px;
}
.pay-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 30px;
    width: 100%;
}
.hour-salary-wrapper {
    display: flex;
    flex-direction: row;
    width: 100%;
}
.hour-salary-btn {
    width: 50%;
    height: 55px;
    border-radius: 12px;
    background-color: transparent;
    border: 1px solid #0000B3;
    color: #f7fafc;
    font-size: 16px;
}
.hour-salary-btn:hover {
    color: #1c1e21;
    background-color: #f7fafc;
    cursor: pointer;
}
.hour-salary-btn.active {
    color: #1c1e21;
    background-color: #f7fafc;
}
.job-description-row {
    font-size: 18px;
    display: flex;
    flex-direction: column;
    color: #f7fafc;
    width: 100%;
    padding-bottom: 16px;

}
.description-field {
    width: 100%;
    font-size: 15px;
    padding-left: 12px;
    padding-top: 10px;
    border-radius: 12px;
    background-color: #1a2542;
    border: 1px solid #0000B3;
    height: 220px;
    color: #f7fafc;
}
.contact-row {
    display: flex;
    flex-direction: row;
    width: 100%;
}
.contact-wrapper {
    display: flex;
    flex-direction: column;

}
.contact-list {
    display: flex;
    flex-direction: column;
    gap: 22px;
    width: 40%;
}
.contact-field {
    display: flex;
    flex-direction: column;
    gap: 3px;
}
</style>
