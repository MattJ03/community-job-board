<template>
    <div class="listing-card">

    </div>
</template>
<script setup>
import { ref, reactive, computed } from "vue";

const props = defineProps({
    listing: {
        type: Object,
        required: true,
    }
});
</script>
<style scoped>
.listing-card {
    width: 100%;
    border: 1px solid #0F172A;
}
</style>
