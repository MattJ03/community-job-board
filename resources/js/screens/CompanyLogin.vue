<template>
    <div class="container">
        <form @submit.prevent="loginCompany(companyForm)" class="form-card">
            <div class="top-of-form">
                <h2 class="login-title">Company login</h2>
            </div>
            <div class="company-details">
                <div class="form-field">
                    <input v-model="companyForm.email" type="email" class="input-field" id="email"/>
                    <label class="name-field" for="email">Email</label>
                    <span class="error-text" v-if="errors.email"> {{ errors.email }}</span>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.password" type="password" class="input-field" id="password"/>
                    <label for="password">Password</label>
                    <span class="error-text" v-if="errors.password"> {{ errors.password }}</span>
                </div>
            </div>
            <div class="buttons-wrapper">
                <button class="company-login">Login</button>
                <button type="button" @click="moveToCompanyReg()" class="company-create-account">Create an account for your company</button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { ref, reactive, computed } from "vue";
import { useCompanyAuthStore } from "../stores/CompanyAuthStore.js";
import router from "../router/index.js";

const loading = ref(false);
const error = ref('');

const companyAuthStore = useCompanyAuthStore();
const companyForm = reactive({
    email: '',
    password: '',
});
const errors = reactive(({
    email: '',
    password: '',
}));


const loginCompany = async (formInfo) => {
    loading.value = true;
    if(!validate()) {
        console.log('validation failed');
        return;
    }
    try {
        await companyAuthStore.loginCompany(formInfo);
        console.log('validation passed');
        await router.push({
            name: 'home',
        });
    } catch (err) {
        error.value = error.response?.data?.message ||  console.log(err);
    } finally {
        loading.value = false;
    }
}

const moveToCompanyReg = async () => {
    loading.value = true;
    try {
        await router.push({
            name: 'register company',
        });
    } catch (err) {
        error.value = error.response?.data?.message || 'failed to move to company register';
    } finally {
        loading.value = false;
    }
}

function validate() {
    let valid = true;

    errors.email = companyForm.email ? '' : 'email required';
    errors.password = companyForm.password ? '' : 'password minimum 6 characters';

    if(!companyForm.email || !companyForm.password) {
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
    width: 35%;
    background-color: #0F172A;
    border-radius: 10px;
    padding-left: 30px;
    margin: auto;
    margin-top: 70px;

}
.top-of-form {
    display: flex;
    flex-direction: column;
    color: #ffffff;
    margin: auto;
}
.company-details {
    display: flex;
    margin-top: 60px;
    padding-left: 12px;
    flex-direction: column;
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
.buttons-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-top: 60px;
    width: 100%;
    padding-bottom: 40px;

}
.company-login {
    width: 55%;
    height: 55px;
    border-radius: 30px;
    background-color: #0000ff;
    color: #ffffff;
    border: 1px solid #0000ff;
    font-size: 16px;
}
.company-login:hover {
    background-color: #0000B3;
    cursor: pointer;
}
.company-create-account {
    width: 55%;
    height: 55px;
    border: 1px solid #0000ff;
    background-color: #ffffff;
    border-radius: 30px;
    font-size: 16px;
    color: #0000ff;
    margin-top: 30px;
}
.company-create-account:hover {
    background-color: #ccd0d5;
    cursor: pointer;
}
.error-text {
    color: #B00020;
    font-size: 16px;
    padding-top: 3px;
}
</style>
