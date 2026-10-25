<template>
    <div class="container">
        <form class="form-card">
          <h2 class="login-header">Login</h2>
            <div class="login-details">
                <div class="form-field">
                <input type="email" class="input-field" id="email"/>
                <label class="field-name" for="email">Email</label>
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" id="password"/>
                    <label for="password" class="field-name">Password</label>
                </div>
            </div>
            <div class="button-wrapper">

            </div>

        </form>
    </div>

</template>
<script setup>
import { ref, reactive, computed } from "vue";

const loading = ref(false);
const error = ref(null);
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
</style>
