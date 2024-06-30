<template>
    <div class="modal fade" tabindex="-1" role="dialog" :class="{ show: props.showEditModal }" v-if="props.showEditModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close btn btn-sm btn-danger" @click="closeEditModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateProduct">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="product.name" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" v-model="product.category" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" v-model="product.description" required></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import { API_EDIT_PRODUCT } from '../../config.js';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    showEditModal: {
        type: Boolean,
        required: true,
    },
    editProduct: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['close', 'product-updated']);

const product = ref({ ...props.editProduct });

watch(() => props.editProduct, (newVal) => {
    product.value = { ...newVal };
});

const closeEditModal = () => {
    emit('close');
};

const updateProduct = async () => {

    try {

        const response = await axios.put(`${API_EDIT_PRODUCT}/${product.value.id}`, product.value);
        closeEditModal();
        emit('product-updated', response.data);

    } catch (error) {

        if (
            error.response &&
            error.response.status === 42
        ) {
            errors.value = error.response.data.errors;
        } else {
            console.error('Error updating product:', error);
        }

    }

};

</script>

<style src="./style.css"></style>

