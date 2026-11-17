import { ref, computed } from 'vue';
import { defineStore } from "pinia";
import api from "../axios.js";
export const useIndustryStore = defineStore('industry', () => {

    const loading = ref(false);
    const error = ref('');
    const industries = ref([]);

   async function getAllIndustries() {
        loading.value = true;
        try {
            const res = await api.get('allIndustries');
            industries.value = res.data.industries;
        } catch (err) {
            error.value = err.response?.data?.message || 'failed to get all industries';
        } finally {
            loading.value = false;
        }
    }



   return {
       error,
       loading,
       industries,
       getAllIndustries,
   }
});
