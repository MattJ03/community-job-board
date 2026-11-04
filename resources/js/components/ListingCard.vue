<template>
    <div class="listing-card">
        <div class="top-listing">
            <div class="img-wrapper">

            </div>

        </div>
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
    display: flex;
    flex-direction: column;
    width: 100%;
    border: 1px solid #0F172A;
}
.top-listing {
    display: flex;
    flex-direction: row;
}
.img-wrapper {
    overflow: hidden;
    height: 40px;
    width: 40px;
}

</style>
