import { ref, reactive, computed } from 'vue';
import { defineStore } from "pinia";
import api from "../axios.js";
export const useAuthStore = defineStore('users', () => {
   const user = ref('');
   const token = ref(null);
   const role = ref(null);
   const loading = ref(false);
   const error = ref('');

   const registerUser = async (payload) => {
       loading.value = true;
       try {
           const res = await api.post('registerUser', payload);
           user.value = res.data.user;
       } catch(err) {
           error.value = error.response?.data?.message || 'failed to register user';
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
   }
});
