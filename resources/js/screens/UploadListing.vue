<template>
    <NavBar></NavBar>
    <div class="container">
        <form @submit.prevent="submitListing(form)" class="form-card">
            <div class="title-company">
                <div class="field">
                    <span class="field-text">Role title</span>
                    <input class="field-input-title" v-model="form.title"/>
                    <span class="error-text" v-if="errors.title"> {{ errors.title }}</span>
                </div>
                <div class="field">
                    <span class="field-text">Company Name</span>
                    <input class="field-input-title" v-model="form.companyName"/>
                    <span class="error-text" v-if="errors.companyName"> {{ errors.companyName }}</span>
                </div>
            </div>
            <div class="industry-field">
                <span class="field-text">Industry</span>
            <div class="industry-selection">
                <span v-for="industry in industries" :key="industry" class="industry-bubble" @click="form.industry = industry"
                :class="{ active: form.industry === industry }"
                > {{ industry }}</span>
            </div>
                <span class="error-text" v-if="errors.industry"> {{ errors.industry }}</span>
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
                    <span class="error-text" v-if="errors.location"> {{ errors.location }}</span>
                </div>
                <div class="field">
                    <span class="field-text">Work from</span>
                    <div class="work-from-wrapper">
                        <button type="button" class="work-type-button" @click="form.work_from = 'remote'"
                        :class="{ active: form.work_from === 'remote'}"
                        >Remote</button>
                        <button type="button" class="work-type-button" @click="form.work_from = 'hybrid'"
                        :class="{ active: form.work_from === 'hybrid'}"
                        >Hybrid</button>
                        <button type="button" class="work-type-button" @click="form.work_from = 'on-site'"
                        :class="{ active: form.work_from === 'on-site'}"
                        >On-site</button>
                    </div>
                    <span class="error-text" v-if="errors.work_from"> {{ errors.work_from }}</span>
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
                        <button type="button" class="hour-salary-btn" @click="form.salary = null; isSalary = false"
                        :class="{ active: !isSalary}"
                        >Hourly role</button>
                        <button type="button" class="hour-salary-btn" @click="form.hourly = null; isSalary = true"
                        :class="{ active: isSalary}"
                        >Salary role</button>
                    </div>
                </div>
                <div class="field" v-if="!isSalary">
                    <span class="field-text">Approximate pay (per hour)</span>
                    <input type="number" v-model="form.hourly" class="field-input-title"/>
                </div>
                <div class="field" v-if="isSalary">
                    <span class="field-text">Approximate salary</span>
                    <input type="number" v-model="form.salary" class="field-input-title"/>
                    <span class="error-text" v-if="errors.pay"> {{ errors.pay }}</span>
                </div>
            </div>

            </div>
            <div class="horizontal-line"></div>
            <div class="job-description-row">
                <span class="field-text-header">Description</span>
                <span class="field-text">Job responsibilities</span>
                <textarea class="description-field" v-model="form.description" maxlength="2000"/>
                <span class="error-text" v-if="errors.description"> {{ errors.description }}</span>
            </div>
            <div class="horizontal-line"></div>
            <div class="job-description-row">
                <span class="field-text-header">Requirements & Qualifications</span>
                <textarea class="description-field" v-model="form.requirements"/>
                <span class="error-text" v-if="errors.requirements"> {{ errors.requirements }}</span>
            </div>
            <div class="horizontal-line"></div>
                <div class="job-description-row">
                    <span class="field-text-header">Minimum qualifications (optional)</span>
                    <textarea class="description-field" v-model="form.minimum_qualification"/>
                </div>
            <div class="horizontal-line"></div>
            <div class="field">
                <span class="field-text">minimum years of relevant experience (optional)</span>
                <select class="years-of-experience-input" v-model="form.years_of_experience">
                    <option>0</option>
                    <option v-for="num in oneToTen"> {{ num }}</option>
                </select>
            </div>
            <div class="contact-wrapper">
            <span class="field-text-header">Contact info</span>
            <div class="contact-row">
                <div class="contact-list">
                    <div class="contact-field">
                        <span class="field-text">Email</span>
                    <input class="field-input-title" v-model="placeholderContact.email" disabled/>
                    </div>
                    <div class="contact-field">
                        <span class="field-text">Company number</span>
                    <input class="field-input-title" v-model="placeholderContact.phone_number" disabled/>
                    </div>
                </div>
            </div>
            </div>
            <div class="horizontal-line"></div>
            <div class="buttons-row">
                <button  class="submit-btn">Post job</button>
            </div>
        </form>
    </div>
</template>
<script setup>
import {ref, reactive, computed, onMounted, watch} from "vue";
import { useCompanyAuthStore } from "../stores/CompanyAuthStore.js";
import NavBar from "../components/NavBar.vue";
import { storeToRefs } from "pinia";
import { useListingStore } from "../stores/ListingStore.js";
import router from "../router/index.js";



const loading = ref(false);
const error = ref('');
const companyStore = useCompanyAuthStore();
const industries = ref(['Software', 'Plumbing', 'Electrical', 'Mechanical', 'Gardening', 'Design', 'Moving', 'Transport', 'Roofing', 'Carpentry', 'Marketing', 'Business', 'Retail', 'Construction', 'Hospitality']);
const locations = ref(['Belfast', 'Londonderry', 'Lisburn', 'Newry', 'Armagh', 'Bangor', 'Craigavon', 'Ballymena', 'Omagh', 'Enniskillen', 'Coleraine', 'Newtownards', 'Antrim (town)', ])
const counties = ref(['Fermanagh', 'Antrim', 'Tyrone', 'Londonderry', 'Armagh', 'Down']);
const oneToTen = ref([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
const form = reactive({
    title: '',
    companyName: '',
    industry: '',
    location: '',
    work_from: '',
    hourly: null,
    salary: null,
    description: '',
    requirements: '',
    minimum_qualification: '',
    years_of_experience: '',

});
const errors = reactive({
    title: '',
    companyName: '',
    industry: '',
    location: '',
    work_from: '',
    pay: '',
    description: '',
    requirements: '',
    years_of_experience: '',
});
const listingStore = useListingStore();
const { company } = storeToRefs(companyStore);

const placeholderContact = reactive({
    email: '',
    phone_number: '',
});
watch(company, (newValue) => {
    if(newValue) {
        Object.assign(placeholderContact, {
            email: newValue.email || '',
            phone_number: newValue.phone_number || '',
        });
    }
}, {immediate: true});

console.log(placeholderContact.email)
const isSalary = ref(true);

onMounted(async () => {
    await companyStore.getCurrentAccount();
    console.log(company.value);
});

const submitListing = async (formValues) => {
    if(!validate()) {
        console.log('invalid job form');
        return;
    }
    loading.value = true;
    try {
        await listingStore.storeListing(formValues);
        await router.push({
            name: 'home',
        });
    } catch (err) {
        error.value = err.response?.data?.message || 'failed to store listing';
    } finally {
        loading.value = false;
    }
}

function validate() {
    let valid = true;

    errors.title = form.title ? '' : 'job title required';
    errors.companyName = form.companyName ? '' : 'company name required';
    errors.industry = form.industry ? '' : 'industry required';
    errors.location = form.location ? '' : 'location required';
    errors.work_from = form.work_from ? '' : 'work from required';
    errors.description = form.description ? '' : 'job description required';
    errors.requirements = form.requirements ? '' : 'role requirements required';
    if(!form.title || !form.companyName || !form.industry || !form.location || !form.work_from || (!form.hourly && !form.salary) || !form.description || !form.requirements) {
        valid = false;
    }
    if(!form.hourly && !form.salary) {
        errors.pay = 'approximate pay must be set';
        valid = false;
    }

    return valid;
}
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
    padding-bottom: 40px;
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
    cursor: pointer;
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
.contact-field input {
    background-color: #4a5568;
    cursor: not-allowed;
}
.years-of-experience-input {
    background-color: #1a2542;
    height: 45px;
    width: 25%;
    border-radius: 14px;
    border: 1px solid #0000B3;
    color: #f7fafc;
    font-size: 16px;
    cursor: pointer;
    padding-left: 8px;
}
.buttons-row {
    display: flex;
    flex-direction: row;
    width: 100%;
    padding-bottom: 12px;
}
.submit-btn {
    width: 20%;
    font-size: 16px;
    font-weight: bold;
    background-color: #0000ff;
    color: #f7fafc;
    border-radius: 12px;
    border: 1px solid #0000ff;
    height: 55px;
}
.submit-btn:hover {
    background-color: #0000B3;
    cursor: pointer;
}
.error-text {
    color: #B00020;
    font-size: 14px;
    padding-top: 5px;
}

@media(max-width: 900px) {
    .form-card {
        width: 90%;
        margin-top: 30px;
        padding-left: 12px;
        padding-right: 12px;
        gap: 18px;
        padding-bottom: 20px;
    }
    .industry-selection {
        gap: 10px;
        font-size: 15px;

    }
    .industry-bubble {
        font-size: 16px;
        padding: 10px 12px;
    }
    .field-text {
        font-size: 15px;
        margin-bottom: 10px;
    }
    .location-row {
        justify-content: center;
        gap: 16px;
    }
    .field-dropdown-location {
        width: 95%;
    }
    .location-row {
        gap: 3px;
    }
    .work-type-button {
        font-size: 15px;

    }
    .work-from-wrapper {
        width: 105%;
        justify-content: normal;
        margin-right: 20px;
    }
    .years-of-experience-input {
        width: 40%;
    }
    .submit-btn {
        width: 32%;
    }
}
</style>
