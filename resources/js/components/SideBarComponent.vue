<template>
    <div class="sidebar">
        <h2 class="sidebar-title">Menu</h2>
        <div class="sidebar-grid">
            <a href="/admin/product" class="sidebar-item">Products</a>
            <a href="/admin/videos" class="sidebar-item">Videos</a>
            <a href="#" class="sidebar-item">Item 1</a>
            <a href="#" class="sidebar-item">Item 2</a>
        </div>
    </div>
</template>

<style scoped>
.sidebar {
    width: 100%;
    height: 100%;
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.sidebar-title {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #222121;
}



.sidebar-item {
    display: block;
    padding: 8px 12px; /* Adjust padding to make buttons smaller */
    background-color: orange;
    color: #fff0f0;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    margin-bottom: 10px;
}

.sidebar-item:hover {
    background-color: #1f1e1e;
}
</style>
