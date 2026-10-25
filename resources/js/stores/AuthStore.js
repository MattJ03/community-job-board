import { ref, reactive, computed } from 'vue';
import { defineStore } from "pinia";

export const useAuthStore = defineStore('users', () => {
   const user = ref('');
   const token = ref(null);
   const role = ref(null);
   const loading = ref(false);
   const error = ref('');

   const registerUser = (payload) => {
       loading.value = true;
   }
});
