<template>
    <div class="container">
        <div class="form-card">
            <h2 class="register-title">Register company</h2>
            <div class="company-details">
                <div class="form-field">
                    <input type="text" class="input-field" id="name"/>
                    <label for="name" class="field-name">Company name</label>
                </div>
                <div class="form-field">
                    <input type="email" class="input-field" id="email"/>
                    <label for="email" class="field-name">Email</label>
                </div>
                <div class="form-field">
                    <input type="text" class="input-field" id="industry"/>
                    <label for="industry">Industry</label>
                </div>
                <div class="form-field">
                    <select class="employee-num-dropdown" id="number of employees">
                        <option v-for="num in employeeNumRange"> {{ num }} </option>
                    </select>
                </div>
                <div class="form-field">
                    <input type="number" class="input-field" id="phone number"/>
                    <label for="phone number" class="field-name">Phone number</label>
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" id="password" />
                    <label for="password" class="field-name">Password</label>
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" id="confirm password"/>
                    <label for="confirm password" class="field-name">Confirm password</label>
                </div>
            </div>
        </div>
    </div>

</template>
<script setup>
import { ref, reactive, computed } from "vue";
import { useAuthStore } from "../stores/AuthStore.js";

const employeeNumRange = ref(['1-5', '6-10', '11-50', '51-200', '200-999', '1000+']);
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
.register-title {
    color: #ffffff;
    margin: auto;
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
    height: 50px;
    border-radius: 10px;
    background-color: #ffffff;
}
.employee-num-dropdown:hover {
    background-color: #f7fafc;
    cursor: pointer;
}
</style>
