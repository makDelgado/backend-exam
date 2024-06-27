<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="product-title">
                <h3>Product </h3>
            <button class="btn btn-primary">Add</button>  
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const products = ref([]);
const currentPage = ref(1);
const pageSize = 5;
const loading = ref(true);

const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * pageSize;
    return products.value.slice(start, start + pageSize);
});

const totalPages = computed(() => Math.ceil(products.value.length / pageSize));

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

const gotoPage = (page) => {
    currentPage.value = page;
};

const editProduct = (product) => {
    // Implement edit functionality here
};
</script>
