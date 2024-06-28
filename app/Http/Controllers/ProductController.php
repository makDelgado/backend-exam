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
    public function addProducts(Request $request)
    {

        $product = new Product();
        $product->name = $request['name'];
        $product->category = $request['category'];
        $product->description = $request['description'];
        $product->save();

        return response()->json([
            'success' => true,
            'product' => $product,
        ]);
    }
}
