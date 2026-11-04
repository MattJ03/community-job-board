import { ref, reactive, computed } from 'vue';
import { defineStore } from "pinia";
import api from "../axios.js";

export const useListingStore = defineStore('listings', () => {
    const loading = ref(false);
    const error = ref('');
    const totalListings = ref('');
    const listing = ref('');

    const getAllListings = async (filters = {}) => {
        loading.value = true;
        try {
            const res = await api.get('listingsIndex', {
                params: filters,
            });
            totalListings.value = res.data.listings.data;
        } catch (err) {
            error.values = error.response?.data?.message || 'failed to get total listings';
        }
        finally {
            loading.value = false;
        }
    }

    return {
        loading,
        error,
        totalListings,
        listing,
        getAllListings,
    };

});
