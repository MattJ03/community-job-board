<template>
    <NavBar></NavBar>
    <div class="container">
        <div class="form-card">
            <div class="title-company">
                <div class="field">
                    <span class="field-text">Role title</span>
                    <input class="field-input-title"/>
                </div>
                <div class="field">
                    <span class="field-text">Company Name</span>
                    <input class="field-input-title"/>
                </div>
            </div>
            <div class="industry-selection">
                <span class="industry-bubble-option"></span>
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
    width: 55%;
    padding-left: 32px;
    padding-right: 32px;
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
}
.industry-bubble-option {
    font-size: 17px;

}
</style>
