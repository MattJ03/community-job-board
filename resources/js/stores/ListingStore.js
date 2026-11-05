import { ref, reactive, computed } from 'vue';
import { defineStore } from "pinia";
import api from "../axios.js";

export const useListingStore = defineStore('listings', () => {
    const loading = ref(false);
    const error = ref('');
    const totalListings = ref([]);
    const listing = ref('');

    const getAllListings = async (filters = {}) => {
        loading.value = true;
        try {
            const res = await api.get('listingsIndex', {
                params: filters,
            });
            const newItems = res.data.listings.data;
            const currentPage = filters.page || 1;

            if(currentPage === 1) {
            totalListings.value = newItems;
                } else {
            totalListings.value = [...totalListings.value, ...newItems];
                }
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
