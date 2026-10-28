import { ref, reactive, computed } from 'vue';
import { defineStore } from "pinia";
import api from '../axios.js';

export const useCompanyAuthStore = defineStore('companies', () => {
   const loading = ref(false);
   const error = ref('');
   const company = ref(null);
   const token = ref(localStorage.getItem('token'));

   const registerCompany = async (payload) => {
       loading.value = true;
       try {
           const res = await api.post('registerCompany', payload);
           company.value = res.data.company;
       } catch (err) {
           error.value = err.response?.data?.message || 'failed to register company';
       } finally {
           loading.value = false;
       }
   }

   const loginCompany = async (payload) => {
       loading.value = true;
       try {
           const res = await api.post('loginCompany', payload);
           company.value = res.data.company;
           token.value = res.data.token;
           localStorage.setItem('token', token.value);
       } catch (err) {
           error.value = error.response?.data?.message || 'failed to login to company account';
       } finally {
           loading.value = false;
       }
   }

   return {
       loading,
       error,
       company,
       token,
       registerCompany,
       loginCompany,
   };
});

