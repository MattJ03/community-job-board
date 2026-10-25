<template>
    <div class="container">
        <div class="form-card">
            <h2 class="register-title">Register</h2>
            <div class="details-section">
                <div class="form-field">
                <input type="text" id="name" class="input-field" />
                    <label for="name" class="field-name">Name</label>
                </div>
                <div class="form-field">
                    <input type="email" class="input-field" id="email"/>
                    <label class="field-name" for="email">Email</label>
                </div>
                <div class="form-field">
                    <input type="number" class="input-field" id="number"/>
                    <label for="number">Phone number</label>
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" id="password"/>
                    <label for="password">Password</label>
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" id="passwordConfirmation"/>
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
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, computed } from 'vue';
</script>
<style scoped>
.container {
    display: flex;
    width: 100%;

}
.form-card {
    display: flex;
    flex-direction: column;
    width: 40%;
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
    padding-left: 30px;
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
    border-color: #1F4D3A;
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
    font-size: 12px;
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
    background-color: #f8f9fa;
    cursor: pointer;
}

.login-wrapper {
    display: flex;

    align-items: center;
    flex-direction: column;
    width: 100%;
    margin-top: 40px;
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
</style>
