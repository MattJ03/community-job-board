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

    const storeListing = async (payload) => {
        loading.value = true;
        try {
            const res = await api.post('storeListing', payload);
            listing.value = res.data.listing;
        } catch(err) {
            error.value = err.response?.data?.message || 'failed to store listing';
        } finally {
            loading.value = false;
        }
    }

    const showListing = async (id) => {
        loading.value = true;
        try {
            const res = await api.get(`showListing/${id}`);
            listing.value = res.data.listing;
        } catch(err) {
            error.value = err.response?.data?.message || 'failed to fetch listing';
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
        storeListing,
        showListing,
    };

});
