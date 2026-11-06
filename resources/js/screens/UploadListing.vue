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

            <div class="industry-field">
                <span class="field-text-header">Where and How</span>
                <div class="field">
                    <span class="field-text">Location</span>
                    <select class="field-dropdown-location">
                        <optgroup label="Towns & Cities">
                        <option v-for="location in locations"> {{ location }}</option>
                        </optgroup>
                        <optgroup label="Or just select a county">
                            <option v-for="county in counties"> {{ county }}</option>
                        </optgroup>
                    </select>
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
});
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
    gap: 40px;
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
    gap: 8px;


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
    transition: 0.2s;
}
.industry-bubble.active {
    background-color: #f7fafc;
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
</style>
