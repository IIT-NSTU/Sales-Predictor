<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use File;
use Illuminate\Http\Request;

class productController extends Controller
{
    function productsPage()
    {
        return view('pages.dashboard.product-page');
    }

    function productList(Request $request)
    {
        $userId = $request->header('userId');
        $products = Product::where('user_id', '=', $userId)->with('category')->get();

        return response()->json([
            "status" => "success",
            "message" => "",
            "data" => $products
        ], 200);
    }

    function productListSale(Request $request)
    {
        $userId = $request->header('userId');
        return Product::where('user_id', '=', $userId)->where('unit', '>', '0')->get();
    }

    function productById(Request $request)
    {
        $productId = $request->id;
        $userId = $request->header('userId');

        return Product::where('user_id', '=', $userId)->where('id', '=', $productId)->first();
    }

    function createProduct(Request $request)
    {
        $userId = $request->header('userId');
        $categoryId = $request->input('category_id');

        try {
            $product = Product::where('user_id', '=', $userId)
                              ->where('category_id', $categoryId)
                              ->where('name', $request->input('name'))
                              ->first();
            if ($product) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Product Already Exists'
                ], 400);
            }                  

            $imgUrl = "";

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $currentTime = time();
                $fileExtension = $img->extension();
                $imgName = "{$userId}-{$currentTime}.{$fileExtension}";
                $imgUrl = "uploads/{$imgName}";

                // Upload File
                $img->move(public_path('uploads'), $imgName);
            } 

            // Update to Database
            Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'details_url' => $request->input('details'),
                'img_url' => $imgUrl,
                'user_id' => $userId,
                'category_id' => $categoryId,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product creation failed'
            ], 400);
        }
    }

    function deleteProduct(Request $request)
    {
        try {
            $userId = $request->header('userId');
            $productId = $request->input('id');

            $product = Product::where('id', '=', $productId)
                ->where('user_id', '=', $userId);

            if ($product->count() === 1) {
                $product->delete();
                File::delete($request->input('img_url'));

                return response()->json([
                    "status" => "success",
                    "message" => "Product deleted successfully"
                ], 200);
            }

            throw new Exception("product not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "product deleting failed"
            ], 400);
        }
    }

    function updateProduct(Request $request)
    {
        try {
            $userId = $request->header('userId');
            $product = Product::where('id', '=', $request->input('id'))
                ->where('user_id', '=', $userId);

            if ($product->count()===1) {

                if ($request->hasFile('img')) {

                    $img = $request->file('img');
                    $currentTime = time();
                    $fileExtension = $img->extension();
                    $imgName = "{$userId}-{$currentTime}.{$fileExtension}";
                    $imgUrl = "uploads/{$imgName}";

                    // Update Database
                    $product->update([
                        "name" => $request->input('name'),
                        "price" => $request->input('price'),
                        "img_url" => $imgUrl,
                        "unit" => $request->input('unit'),
                        "category_id" => $request->input('category_id')
                    ]);

                    // Save New Img
                    $img->move(public_path('uploads'), $imgName);

                    // Delete old Img
                    File::delete($request->input('old_img'));

                } else {

                    // Update Database
                    $product->update([
                        "name" => $request->input('name'),
                        "price" => $request->input('price'),
                        "unit" => $request->input('unit'),
                        "category_id" => $request->input('category_id'),
                        "details_url" => $request->input('details')
                    ]);
                }
                return response()->json([
                    "status" => "success",
                    "message" => "Product updated successfully"
                ], 200);
            }
            throw new Exception("Product not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Updating product failed"
            ], 400);
        }
    }
}