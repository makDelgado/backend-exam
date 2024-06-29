<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();
        try {

            $product = new Product();
            $product->name = $request['name'];
            $product->category = $request['category'];
            $product->description = $request['description'];
            $product->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'product' => $product,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(
                [
                    'error' => 'Failed to delete product',
                    'message' => $e->getMessage()
                ],
            500);
        }
    }

    public function deleteProduct($id)
    {
        
        DB::beginTransaction();
        try {

            $product = Product::findOrFail($id);
            $product->delete();
            DB::commit();
            return response()->json(['message' => 'Product deleted successfully']);

        } catch (\Exception $e) {

            DB::rollBack();
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
        
        DB::beginTransaction();
        try {

            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
    
            $product->name = $request->input('name');
            $product->category = $request->input('category');
            $product->description = $request->input('description');
            $product->update();
            DB::commit();
    
            return response()->json($product, 200);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(
                [
                    'error' => 'Failed to delete product',
                    'message' => $e->getMessage()
                ],
            500);
        }
    }
}
