<template>
    <div class="container">
        <form v-if="currentStep === 1" @submit.prevent="submitRegisterCompany(companyForm)" class="form-card">
            <div class="top-of-form">
            <h2 class="register-title">Register company</h2>
                <span @click="moveToUserRegister()" class="users-move-text">register individual account?</span>
            </div>
            <div class="company-details">
                <div class="form-field">
                    <input v-model="companyForm.name" type="text" class="input-field" id="name"/>
                    <label for="name" class="field-name">Company name</label>
                    <span class="error-text" v-if="errors.name"> {{errors.name }} </span>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.email" type="email" class="input-field" id="email"/>
                    <label for="email" class="field-name">Email</label>
                    <span class="error-text" v-if="errors.email">{{ errors.email }}</span>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.industry" type="text" class="input-field" id="industry"/>
                    <label for="industry">Industry</label>
                    <span class="error-text" v-if="errors.industry"> {{ errors.industry }}</span>
                </div>
                <div class="form-field-dropdown">
                    <select v-model="companyForm.number_of_employees" class="employee-num-dropdown" id="number of employees">
                        <option v-for="num in employeeNumRange"> {{ num }} </option>
                    </select>
                    <label class="field-name">Number of employees</label>
                    <span class="error-text" v-if="errors.number_of_employees"> {{ errors.number_of_employees }}</span>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.phone_number" type="number" class="input-field" id="phone number"/>
                    <label for="phone number" class="field-name">Phone number</label>
                    <span class="error-text" v-if="errors.phone_number"> {{ errors.phone_number }}</span>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.password" type="password" class="input-field" id="password" />
                    <label for="password" class="field-name">Password</label>
                    <span class="error-text" v-if="errors.password"> {{ errors.password }}</span>
                </div>
                <div class="form-field">
                    <input v-model="companyForm.password_confirmation" type="password" class="input-field" id="confirm password"/>
                    <label for="confirm password" class="field-name">Confirm password</label>
                    <span class="error-text" v-if="errors.password_confirmation"> {{ errors.password_confirmation }}</span>
                </div>
            </div>
            <div class="buttons-wrapper">
                <button class="submit-btn">Register {{ companyForm.name}} </button>
                <button type="button" @click="moveToCompanyLogin()" class="login-company-btn">Move to company login</button>
            </div>
        </form>
        <div v-if="currentStep === 2" class="form-card-logo-upload">
            <h2 class="register-title-upload">Upload company logo</h2>
            <p>Account registered! Now time to add a company logo</p>

            <label class="add-logo-field-name">Image upload</label>
            <label class="add-logo" @click="triggerFileInput()">Add logo</label>
            <img v-if="previewUrl" :src="previewUrl" class="logo-preview-thumb" />
            <input type="file" ref="fileInput" style="display: none;" accept="image/*" @change="handleFileSelect($event)"/>

            <div class="upload-btn-wrapper">
            <button class="upload-img-button" @click="addCompanyLogo()" :disabled="!selectedFile"> Upload logo</button>
            </div>
            </div>
    </div>

</template>
<script setup>
import { ref, reactive, computed } from "vue";
import router from "../router/index.js";
import api from "../axios.js";
import { useCompanyAuthStore } from "../stores/CompanyAuthStore.js";
import add from '../assets/add.png';

const loading = ref(false);
const error = ref('');
const companyAuthStore = useCompanyAuthStore();
const companyForm = reactive({
    name: '',
    email: '',
    industry: '',
    number_of_employees: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
});

const fileInput = ref(null);
const selectedFile = ref(null);
const currentStep = ref(1);
const companyId = ref(null);
const previewUrl = ref(null);
const errors = reactive({
    name: '',
    email: '',
    industry: '',
    number_of_employees: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
});
setTimeout(() => {
    console.log(companyId.value);
}, 20000);
const employeeNumRange = ref(['1-5', '6-10', '11-50', '51-200', '200-999', '1000+']);

function triggerFileInput() {
    fileInput.value.click();
}
const submitRegisterCompany = async (formInfo) => {
    loading.value = true;
    if(!validate()) {
        console.log('invalid form info');
        return;
    }
    try {
       const response =  await companyAuthStore.registerCompany(formInfo);
        companyId.value = companyAuthStore.company.id || 'failed to get company id';
        currentStep.value = 2;
    } catch(err) {
        error.value = error.response?.data?.message || 'failed to register company';
    } finally {
        loading.value = false;
    }
}
function validate() {
    let valid = true;

    errors.name = companyForm.name ? '' : 'company name required';
    errors.email = companyForm.email ? '' : 'company email required';
    errors.industry = companyForm.industry ? '' : 'industry required';
    errors.number_of_employees = companyForm ? '' : 'number of employees required';
    errors.phone_number = companyForm.phone_number ? '' : 'phone number required';
    errors.password = companyForm.password ? '' : 'password required';
    errors.password_confirmation = companyForm ? '' : 'password confirmation required';

    if(!companyForm.name || !companyForm.email || !companyForm.industry || !companyForm.number_of_employees || !companyForm.phone_number ||
       !companyForm.password || !companyForm.password_confirmation) {
        valid = false;
    }

    return valid;
}

const handleFileSelect = (event) => {
    const file = event.target.files[0];
    if (!file) return;

    selectedFile.value = file;
    previewUrl.value = URL.createObjectURL(file);
};
const addCompanyLogo = async () => {
        const file = selectedFile.value;
        const formData = new FormData();
        if(!file) {
            return;
        }
        formData.append('logo', file);
    if (companyId.value) {
        formData.append('company_id', companyId.value);
    }
        loading.value = true;
        try {
            const res = await api.post('storeCompanyLogo', formData, {
                headers: {
                    'Content-Type': "multipart/form-data",
                }
            });
            await router.push({
                name: 'login company',
            });
        } catch (err) {
            error.value = err.response?.data?.message || 'failed to upload profile picture';
        } finally {
            loading.value = false;
        }
    }



const moveToUserRegister = async () => {
    loading.value = true;
    try {
        await router.push({
            name: 'register user'
        });
    } catch(err) {
        error.value = error.response?.data?.message || 'failed to move to register user';
    } finally {
        loading.value = false;
    }
}

const moveToCompanyLogin = async () => {
    loading.value = true;
    try {
        await router.push({
            name: 'login company'
        });
    } catch (err) {
        error.value = err.response?.data?.message || 'failed to move to login company screen';
        console.log(error.value);
    } finally {
        loading.value = false;
    }
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
    margin-top: 70px;

}
.top-of-form {
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 30px;
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
.users-move-text:hover {
    cursor: pointer;
    color: #ccd0d5;
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
.error-text {
    color: #B00020;
    font-size: 14px;
}
.add-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 120px;
    border: 1px dotted #f7fafc;
    cursor: pointer;
    border-radius: 14px;
    width: 30%;
    transition: 0.3s;
}

.add-logo:hover {
    background-color: #f7fafc;
    color: #1c1e21;
}
.add-logo-img {
    height: 40px;
    width: 40px;
}
.register-title-upload {
   margin: auto;
    margin-top: 30px;

}
.form-card-logo-upload {
    display: flex;

    flex-direction: column;
    width: 35%;
    background-color: #0F172A;
    border-radius: 10px;
    color: #f7fafc;
    padding-left: 30px;
    margin: auto;
    margin-top: 70px;

}
.add-logo-field-name {
    margin-top: 70px;
    color: #f7fafc;
}
.logo-preview-thumb {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 14px;
}
.upload-btn-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding-bottom: 40px;
}
.upload-img-button {
    width: 55%;
    height: 55px;
    border-radius: 30px;
    background-color: #0000ff;
    color: #ffffff;
    border: 1px solid #0000ff;
    font-size: 16px;
    margin-top: 40px;
    cursor: pointer;

} .upload-img-button:disabled {
    background-color: #949494;
    cursor: not-allowed;
  }
@media (max-width: 900px) {
    .form-card {
        width: 85%;
        margin-top: 40px;
        padding-left: 10px;
    }
    .company-details {
        margin-top: 30px;
    }
    .input-field {
        width: 90%;
    }
    .employee-num-dropdown {
        width: 90%;
    }
    .buttons-wrapper {
        margin-top: 30px;
    }
    .login-company-btn {
        margin-top: 30px;
    }
}
</style>
