<template>
    <div class="sidebar">
        <h2 class="sidebar-title">Menu</h2>
        <ul class="sidebar-list">
            <li class="sidebar-item"><a href="#">Dashboard</a></li>
            <li class="sidebar-item"><a href="/admin/products">Proucts</a></li>
            <li class="sidebar-item"><a href="#">Item 3</a></li>
            <li class="sidebar-item"><a href="#">item 4</a></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'ProductComponent',
};
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
