<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        prod
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
// import { api_endpoint } from './config.js';

const products = ref([]);

const fetchProducts = async () => {
  try {
    const response = await axios.get('/api/products');
    products.value = response.data;
    console.log(products.value);
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

onMounted(fetchProducts);
</script>

<style scoped>
.sidebar {
    width: 200px;
    height: 100vh;
    background-color: #343a40;
    color: #fff;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
}

.sidebar-title {
    font-size: 1.5em;
    margin-bottom: 1em;
    text-align: center;
}

.sidebar-list {
    list-style-type: none;
    padding: 0;
}

.sidebar-item {
    margin: 10px 0;
}

.sidebar-item a {
    text-decoration: none;
    color: #ddd;
    font-size: 1.1em;
    display: block;
    padding: 10px;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

.sidebar-item a:hover {
    background-color: #495057;
    color: #fff;
}
</style>
