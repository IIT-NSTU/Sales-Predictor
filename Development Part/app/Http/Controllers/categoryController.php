<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    function categoriesPage()
    {
        return view('pages.dashboard.category-page');
    }

    function categoryList(Request $request)
    {
        $userId = $request->header('userId');
        $categories = Category::where('user_id', '=', $userId)
                              ->where('active', '=', 1)
                              ->withCount('products')->get();

        return response()->json([
            "status" => "success",
            "message" => "",
            "data" => $categories
        ], 200);
    }

    function createCategory(Request $request)
    {
        try {
            $userId = $request->header('userId');
            $categoryName = $request->input('name');
            $type = $request->input('type');
            $category = Category::where('user_id', '=', $userId)
                                ->where('name', $categoryName)
                                ->first();
            
            if ($category) {
                if ($category['active'] == 0) {
                    $updateCategory = Category::where('id', '=', $category['id']);
                    $updateCategory->update([
                        "active" => 1
                    ]);
                    return response()->json([
                        "status" => "success",
                        "message" => "Category created successfully"
                    ], 201);
                } else {
                    return response()->json([
                        "status" => "failed",
                        "message" => "This Category Already Exists"
                    ], 400);
                }
            } else {
                Category::create([
                    "user_id" => $userId,
                    "name" => $categoryName,
                    "type" => $type
                ]);
                
                return response()->json([
                    "status" => "success",
                    "message" => "Category created successfully"
                ], 201);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong"
            ], 400);
        }
    }

    function updateCategory(Request $request)
    {
        $userId = $request->header('userId');
        $categoryId = $request->input('id');

        try {
            $category = Category::where('id', '=', $categoryId)
                ->where('user_id', '=', $userId);

            if ($category->count() === 1) {
                $category->update([
                    "name" => $request->input('name'),
                    "type" => $request->input('type')
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Category updated successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Category updating failed"
            ], 400);
        }

    }

    function deleteCategory(Request $request)
    {
        $userId = $request->header('userId');
        $categoryId = $request->input('id');

        try {
            $category = Category::where('id', '=', $categoryId)
                ->where('user_id', '=', $userId);

            if ($category->count() === 1) {
                $category->update([
                    "active" => 0
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Category deleted successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Category deleting failed"
            ], 400);
        }
    }

    function categoryByType(Request $request)
    {
        $categoryType = $request->type;
        $userId = $request->header('userId');

        return Category::where('user_id', '=', $userId)
                       ->where('active', '=', 1)
                       ->where('type', '=', $categoryType)
                       ->get();
    }
}