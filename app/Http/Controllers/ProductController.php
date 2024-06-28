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
    public function addProduct(Request $request)
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

    public function deleteProduct($id)
    {
        try {

            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully']);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => 'Failed to delete product',
                    'message' => $e->getMessage()
                ],
            500);
        }
    }
}
