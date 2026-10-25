<template>
    <div class="container">
        <form @submit.prevent="registerUser(form)" class="form-card">
            <h2 class="register-title">Register account</h2>
            <div class="details-section">
                <div class="form-field">
                <input type="text" v-model="form.name" id="name" class="input-field" />
                    <label for="name" class="field-name">Name</label>
                </div>
                <div class="form-field">
                    <input type="email" v-model="form.email" class="input-field" id="email"/>
                    <label class="field-name" for="email">Email</label>
                </div>
                <div class="form-field">
                    <input type="number" v-model="form.number" class="input-field" id="number"/>
                    <label for="number">Phone number</label>
                </div>
                <div class="form-field">
                    <input type="password" v-model="form.password" class="input-field" id="password"/>
                    <label for="password">Password</label>
                </div>
                <div class="form-field">
                    <input type="password" v-model="form.password_confirmation" class="input-field" id="passwordConfirmation"/>
                    <label for="passwordConfirmation">Password confirmation</label>
                </div>
            </div>
            <div class="buttons-wrapper">
                <button class="register-btn">Register</button>
            </div>
            <div class="login-wrapper">
                <span>Already have an account</span>
                <button class="login-screen-btn">Move to login</button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { ref, reactive, computed } from 'vue';
import { useAuthStore } from "../stores/AuthStore.js";

const loading = ref(false);
const error = ref('');
const form = reactive({
    name: '',
    email: '',
    number: '',
    password: '',
    password_confirmation: '',
});
const errors = reactive({
    name: '',
    email: '',
    number: '',
    password: '',
    password_confirmation: '',
});
const authStore = useAuthStore();
async function registerUser(formInfo) {
    if(!validate()) {
        console.log('invalid form');
        return;
    }
    loading.value = true;
    try {
        await authStore.registerUser(formInfo);
    } catch(err) {
        error.value = error.response?.data?.message || 'failed to register user';
    } finally {
        loading.value = false;
    }
}

function validate() {
    let valid = true;

    errors.name = form.name ? '' : 'name is required';
    errors.email = form.email ? '' : 'email required';
    errors.number = form.number ? '' : 'number required';
    errors.password = form.password ? '' : 'enter a password';
    errors.password_confirmation = form.password_confirmation ? '' : 'enter password confirmation';

    if(!form.name || !form.email || !form.number || !form.password || !form.password_confirmation) {
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
    background-color: #0000ff;
    border-radius: 10px;
    padding-left: 30px;
    margin: auto;
    margin-top: 120px;
}
.register-title {
    margin: auto;
    margin-top: 30px;
    color: #ffffff;
}
.details-section {
    display: flex;
    margin-top: 60px;
    flex-direction: column;
    padding-left: 12px;
    gap: 30px;
    color: #ffffff;
    font-size: 18px;
}
.input-field {
    height: 60px;
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
    width: 100%;
    display: flex;
    margin-top: 40px;
    justify-content: center;
}
.register-btn {
    width: 50%;
    height: 55px;
    background-color: #ffffff;
    font-size: 16px;
    border: 1px solid #0000ff;
    color: #0000ff;
    border-radius: 30px;
}
.register-btn:hover {
    background-color: #E1D9D1;
    cursor: pointer;
}

.login-wrapper {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-direction: column;
    width: 100%;
    margin-top: 40px;
    padding-bottom: 20px;
}
.login-wrapper span {
    display: flex;
    justify-content: center;
    color: #ffffff;
}
.login-screen-btn {
    width: 50%;
    height: 45px;
    border-radius: 30px;
    border: 1px solid #ffffff;
    font-size: 16px;
    color: #ffffff;
    background-color: #0000ff;
}
.login-screen-btn:hover {
    background-color: #0000B3;
    cursor: pointer;
}
@media(max-width: 900px) {
    .form-card {
        width: 85%;
        padding-left: 10px;
        margin-top: 40px;
    }

    .input-field {
        width: 90%;
    }
    .buttons-wrapper {
        margin-top: 25px;
    }
    .login-wrapper {
        margin-top: 25px;
    }
}
</style>
