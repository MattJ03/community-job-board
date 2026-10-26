<template>
    <div class="container">
        <form class="form-card">
          <h2 class="login-header">Login</h2>
            <div class="login-details">
                <div class="form-field">
                <input type="email" v-model="form.email" class="input-field" id="email"/>
                <label class="field-name" for="email">Email</label>
                </div>
                <div class="form-field">
                    <input type="password" v-model="form.password" class="input-field" id="password"/>
                    <label for="password" class="field-name">Password</label>
                </div>
            </div>
            <div class="button-wrapper">
                <button class="login-btn">Login</button>
            </div>

        </form>
    </div>

</template>
<script setup>
import { ref, reactive, computed } from "vue";

const loading = ref(false);
const error = ref(null);
const form = reactive({
    email: '',
    password: '',
});
const errors = reactive({
    email: '',
    password: ''
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
        width: 35%;
        background-color: #0000ff;
        border-radius: 10px;
        padding-left: 30px;
        margin: auto;
        margin-top: 120px;
}
.login-header {
    margin: auto;
    color: #ffffff;
    padding-top: 20px;
}
.login-details {
    display: flex;
    margin-top: 120px;
    flex-direction: column;
    padding-left: 12px;
    gap: 30px;
    color: #ffffff;
    font-size: 18px;
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
.button-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 50px;
    width: 100%;
    padding-bottom: 30px;
}
.login-btn {
    width: 50%;
    height: 55px;
    background-color: #ffffff;
    font-size: 16px;
    border: 1px solid #0000ff;
    color: #0000ff;
    border-radius: 30px;
}
.login-btn:hover {
    background-color: #E1D9D1;
    cursor: pointer;
}

</style>
