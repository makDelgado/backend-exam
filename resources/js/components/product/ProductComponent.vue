<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="product-title">
                <h3>Product</h3>
                <button class="btn btn-primary" @click="showAddModal = true">Create</button>
            </div>
            <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert" v-if="showAlert">
                <div> {{ messageNotif }} </div>
                <button type="button" class="close btn btn-sm btn-danger" @click="dismissAlert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="search-bar">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Search by name or description"
                    v-model="searchQuery"
                />
            </div>
            <div v-if="loading" role="status" class="spinner-border"></div>
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
                    <tr v-for="product in paginatedFilteredProducts" :key="product.id">
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

        <Add
            :showAddModal="showAddModal" 
            @close="showAddModal = false"
        />

        <Edit
            :showEditModal="showEditModal"
            @close="showEditModal = false"
            :editProduct="currentProduct"
            @product-updated="handleProductUpdated"
        />

    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { API_SHOW_PRODUCT, API_DELETE_PRODUCT } from '../../config.js';
import Add from './Add.vue';
import Edit from './Edit.vue';
import Swal from 'sweetalert2';

const products = ref([]);
const currentPage = ref(1);
const pageSize = 5;
const loading = ref(true);
const searchQuery = ref('');
const showAddModal = ref(false);
const showEditModal = ref(false);
const showAlert = ref(false);
const timeDelay = 3000;
const messageNotif = ref("");
const currentProduct = ref({});

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

const filteredProducts = computed(() => {
    if (!searchQuery.value) {
        return products.value;
    }
    return products.value.filter(product =>
        product.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        product.description.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const paginatedFilteredProducts = computed(() => {
    const start = (currentPage.value - 1) * pageSize;
    return filteredProducts.value.slice(start, start + pageSize);
});

const totalPages = computed(() => Math.ceil(filteredProducts.value.length / pageSize));

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
    currentProduct.value = product;
    showEditModal.value = true;
};

const handleProductUpdated = (updatedProduct) => {
    const index = products.value.findIndex(p => p.id === updatedProduct.id);
    if (index !== -1) {
        products.value.splice(index, 1, updatedProduct);
    }
    messageNotif.value = "Product Updated Successfully";
    showAlertNotification(); 
};

const deleteProduct = async (product) => {
    Swal.fire({
        icon: 'warning',
        title: "Do you want delete this product",
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                console.log(product);
                const response = await axios.get(`${API_DELETE_PRODUCT}/${product.id}`);
                if (response.status === 200) {
                    products.value = products.value.filter(p => p.id !== product.id);
                    messageNotif.value = "Product deleted successfully!";
                    showAlertNotification();
                } else {
                    console.error('Failed to delete product:', response);
                    messageNotif.value = "Failed to delete product. Please try again later.";
                    showAlertNotification();
                }
            } catch (error) {
                console.error('Error deleting product:', error);
                messageNotif.value = "Failed to delete product. Please try again later.";
                showAlertNotification();
            }
        }
    });
};

window.addEventListener('product-added', (event) => {
    products.value.push(event.detail.product);
    messageNotif.value = "Product Saved Successfully";
    showAlertNotification(); 
});

const showAlertNotification = () => {
    showAlert.value = true;
    setTimeout(() => {
        showAlert.value = false;
    }, timeDelay);
};

const dismissAlert = () => {
    showAlert.value = false;
};
</script>

<style scoped>
.product-title {
    padding: 12px 0;
}

.search-bar {
    margin: 10px 0;
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
