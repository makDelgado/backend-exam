<template>
    <div class="modal fade" tabindex="-1" role="dialog" :class="{ show: props.showAddModal }" v-if="props.showAddModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close btn btn-sm btn-danger" @click="closeAddModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addProduct">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="newProduct.name" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" v-model="newProduct.category" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" v-model="newProduct.description" required></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { API_ADD_PRODUCT } from '../../config.js';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    showAddModal: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(['close']);

const newProduct = ref({
    name: '',
    category: '',
    description: ''
});

const closeAddModal = () => {
    emit('close');
    
    newProduct.value = {
        name: '',
        category: '',
        description: ''
    };
};

const addProduct = async () => {
    try {

        console.log(newProduct.value);
        const response = await axios.post(API_ADD_PRODUCT, newProduct.value);
        console.log(response);
        closeAddModal();

        const addedProduct = response.data; // Assuming the response contains the added product details
        window.dispatchEvent(new CustomEvent('product-added', { detail: addedProduct }));

        
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            console.error('Error adding product:', error);
        }
    }
};

</script>

<style scoped>
.modal {
    display: block;
    background: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
    padding-top: 10vh;
}

.modal-dialog {
    position: relative;
    margin: auto;
    transform: none;
}
</style>
