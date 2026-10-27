<template>
    <div class="container">
        <div class="form-card">
            <div class="top-of-form">
            <h2 class="register-title">Register company</h2>
                <span class="users-move-text">Move to users log in</span>
            </div>
            <div class="company-details">
                <div class="form-field">
                    <input v-model="companyForm.name" type="text" class="input-field" id="name"/>
                    <label for="name" class="field-name">Company name</label>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.email" type="email" class="input-field" id="email"/>
                    <label for="email" class="field-name">Email</label>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.industry" type="text" class="input-field" id="industry"/>
                    <label for="industry">Industry</label>
                </div>
                <div class="form-field-dropdown">
                    <select v-model="companyForm.number_of_employees" class="employee-num-dropdown" id="number of employees">
                        <option v-for="num in employeeNumRange"> {{ num }} </option>
                    </select>
                    <label class="field-name">Number of employees</label>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.phone_number" type="number" class="input-field" id="phone number"/>
                    <label for="phone number" class="field-name">Phone number</label>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.password" type="password" class="input-field" id="password" />
                    <label for="password" class="field-name">Password</label>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.password_confirmation" type="password" class="input-field" id="confirm password"/>
                    <label for="confirm password" class="field-name">Confirm password</label>
                </div>
            </div>
            <div class="buttons-wrapper">
                <button class="submit-btn">Register {{ companyForm.name}} </button>
                <button class="login-company-btn">Move to company login</button>
            </div>
        </div>
    </div>

</template>
<script setup>
import { ref, reactive, computed } from "vue";
import { useAuthStore } from "../stores/AuthStore.js";

const loading = ref(false);
const error = ref('');
const companyForm = reactive({
    name: '',
    email: '',
    industry: '',
    number_of_employees: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
});

const errors = reactive({
    name: '',
    email: '',
    industry: '',
    number_of_employees: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
});
const employeeNumRange = ref(['1-5', '6-10', '11-50', '51-200', '200-999', '1000+']);

function validate() {
    let valid = true;

    errors.name = companyForm.name ? '' : 'company name required';
    errors.email = companyForm.email ? '' : 'company email required';
    errors.industry = companyForm.industry ? '' : 'industry required';
    errors.number_of_employees = companyForm ? '' : 'number of employees required';
    errors.phone_number = companyForm.phone_number ? '' : 'phone number required';
    errors.password = companyForm.password ? '' : 'password required';
    errors.password_confirmation = companyForm ? '' : 'password confirmation required';

    if(!companyForm.name || !!companyForm.email || !companyForm.industry || !companyForm.number_of_employees || !companyForm.phone_number ||
       !companyForm.password || !companyForm.password_confirmation) {
        valid = false;
    }

    return valid;
}
</script>
<style scoped>
.container {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.form-card {
    display: flex;
    flex-direction: column;
    width: 35%;
    background-color: #0F172A;
    border-radius: 10px;
    padding-left: 30px;
    margin: auto;
    margin-top: 120px;

}
.top-of-form {
    display: flex;
    align-items: center;
    flex-direction: row;
    margin-top: 30px;
}
.register-title {
    color: #ffffff;
    margin: auto;
}
.users-move-text {
    color: #ffffff;
    margin-right: 10px;
    border-bottom: 1px solid #ffffff;
}
.company-details {
    display: flex;
    margin-top: 60px;
    flex-direction: column;
    padding-left: 12px;
    gap: 30px;
}
.input-field {
    height: 55px;
    padding-left: 20px;
    padding-top: 6px;
    width: 70%;
    border-radius: 14px;
    border: solid 1px #ccd0d5;
    font-size: 16px;

}
.input-field:focus {
    outline: none;
    border-color: #1F4D3A;;
}
.input-field:hover {
    border: 1px solid ;
}
.form-field {
    display: flex;
    flex-direction: column;
    position: relative;

}
.form-field label {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    color: #65676b;
    pointer-events: none;
    transition: all 0.15s ease;
}

.input-field:focus ~ label,
.input-field:not(:placeholder-shown) ~ label {
    top: 5px;
    transform: translateY(0);
    font-size: 14px;
    color: #1c1e21;
}
.employee-num-dropdown {

    width: 70%;
    font-size: 16px;
    padding-left: 6px;
    height: 55px;
    border-radius: 10px;
    background-color: #ffffff;
}
.employee-num-dropdown:hover {
    background-color: #f7fafc;
    cursor: pointer;
}
.form-field-dropdown {
    display: flex;
    flex-direction: column;
    position: relative;

}
.form-field-dropdown label {
    position: absolute;
    left: 13px;
    top: 20%;
    padding-top: 3px;
    transform: translateY(-50%);
    font-size: 14px;
    pointer-events: none;
    transition: all 0.15s ease;
}
.buttons-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-top: 60px;
    width: 100%;
    padding-bottom: 40px;
}
.submit-btn {
    width: 55%;
    height: 55px;
    border-radius: 30px;
    background-color: #0000ff;
    color: #ffffff;
    border: 1px solid #0000ff;
    font-size: 16px;
}
.submit-btn:hover {
    background-color: #0000B3;
    cursor: pointer;
}
.login-company-btn {
    width: 55%;
    height: 55px;
    border: 1px solid #0000ff;
    background-color: #ffffff;
    border-radius: 30px;
    font-size: 16px;
    color: #0000ff;
    margin-top: 40px;
}
.login-company-btn:hover {
    background-color: #ccd0d5;
    cursor: pointer;
}
</style>
