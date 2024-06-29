<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function showProductPage()
    {
        return view("admin.product.product");
    }

    public function showvideoPage()
    {
        return view("admin.video.index");
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

    public function updateProduct(Request $request, $id)
    {
        try {

            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
    
            $product->name = $request->input('name');
            $product->category = $request->input('category');
            $product->description = $request->input('description');
            $product->update();
    
            return response()->json($product, 200);

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
