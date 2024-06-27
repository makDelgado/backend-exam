<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="product-title">
                <h3>Product </h3>
            <a href="/admin/product/add" class="btn btn-primary">Add</a>  
            </div>     
            <div  v-if="loading" role="status" class="spinner-border"></div>
            <table v-else class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in paginatedProducts" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.category }}</td>
                        <td>{{ product.description }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" @click="editProduct(product)">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" @click="deleteProduct(product)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                        <a class="page-link" href="#" @click.prevent="prevPage">&laquo;</a>
                    </li>
                    <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
                        <a class="page-link" href="#" @click.prevent="gotoPage(page)">{{ page }}</a>
                    </li>
                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                        <a class="page-link" href="#" @click.prevent="nextPage">&raquo;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { API_SHOW_PRODUCT } from '../../config.js';

const products = ref([]);
const currentPage = ref(1);
const pageSize = 5; // Number of items per page
const loading = ref(true);

const fetchProducts = async () => {
    try {
        const response = await axios.get(API_SHOW_PRODUCT);
        products.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchProducts);

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
    
};
</script>

<style scoped>
.product-title {
    padding: 12px 0;
}

table {
    width: 100%;
    margin-top: 5px;
}

.pagination {
    margin-top: 10px;
}

.pagination .page-link {
    cursor: pointer;
}

.spinner-border {
    margin: 20px auto;
    display: block;
}
</style>
