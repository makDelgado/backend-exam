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
                        <div class="form-group">
                            <label for="datetime">Date and Time</label>
                            <datetime-picker v-model="newProduct.datetime" class="form-control" id="datetime"></datetime-picker>
                        </div><br>
                        <div class="form-group">
                            <label for="images">Images</label>
                            <input type="file" id="images" ref="images" multiple accept="image/*">
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
import DatetimePicker from 'vue3-datepicker';

const props = defineProps({
    showAddModal: {
        type: Boolean,
        required: true,
    },
});

const newProduct = ref({
    name: '',
    category: '',
    description: '',
});

const emit = defineEmits(['close']);

const closeAddModal = () => {
    emit('close');
    
    newProduct.value = {
        name: '',
        category: '',
        description: '',
        datetime: null,
    };
};

const addProduct = async () => {

    try {

        // Basic validation before submission
        if (
            !newProduct.value.name ||
            !newProduct.value.category ||
            !newProduct.value.description
        ) {
            console.error('Please fill in all fields.');
            return;
        }

        const formData = new FormData();
        formData.append('name', newProduct.value.name);
        formData.append('category', newProduct.value.category);
        formData.append('description', newProduct.value.description);
  
        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };

        const response = await axios.post(API_ADD_PRODUCT, formData, config);
        closeAddModal();
        
        const addedProduct = response.data;
        window.dispatchEvent(new CustomEvent('product-added', { detail: addedProduct }));
        
    } catch (error) {
        console.error('Error adding product:', error);
    }
};
</script>

<style src="./style.css"></style>

