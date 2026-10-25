<template>
    <div class="container">
        <div class="form-card">
            <h2 class="register-title">Register</h2>
            <div class="details-section">
                <div class="form-field">
                <input type="text" id="name" class="input-field" />
                    <label for="name" class="field-name">Name</label>
                </div>
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


</style>
