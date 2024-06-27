<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index()
    {
        return view("admin.product.product");
    }
    public function showProducts()
    {
        return Product::all();
    }
    public function addProduct()
    {
        return view("admin.product.add_product");
    }
    public function editProduct()
    {
        return view("admin.product.edit_product");
    }
}
