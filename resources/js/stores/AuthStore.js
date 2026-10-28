import { ref, reactive, computed } from 'vue';
import { defineStore } from "pinia";
import api from "../axios.js";
import {local} from "laravel-vite-plugin/fonts";
export const useAuthStore = defineStore('users', () => {
   const user = ref('');
   const token = ref(localStorage.getItem('token'));
   const role = ref(null);
   const loading = ref(false);
   const error = ref('');

   const registerUser = async (payload) => {
       loading.value = true;
       try {
           const res = await api.post('registerUser', payload);
           user.value = res.data.user;
           token.value = res.data.token;
           localStorage.setItem('token', token.value);
       } catch(err) {
           error.value = error.response?.data?.message || 'failed to register user';
       } finally {
           loading.value = false;
       }
   }

   const loginUser = async (payload) => {
       loading.value = true;
       try {
           const res = await api.post('loginUser', payload);
           user.value = res.data.user;
           token.value = res.data.token;
          localStorage.setItem('token', token.value);
           console.log(res.data.token);
       } catch (err) {
           error.value = err.response?.data?.message || 'failed to login user';
           throw err;
       } finally {
           loading.value = false;
       }
   }

   return {
       user,
       token,
       role,
       loading,
       error,
       registerUser,
       loginUser,
   }
});
