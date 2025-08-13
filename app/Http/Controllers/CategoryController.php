<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Create category for blogs
    public function createCategory(Request $request)
    {
        $category_name = $request->category_name;
        if (!$category_name) {
            return redirect('/categories')->with('error', 'Category name is required!!');
        }

        try {
            $categoryExists = DB::table('categories')
                ->where('name', $category_name)->first();

            if ($categoryExists) {
                // return response()->json(['error' => 'Category name already exists!!']);
                return redirect('/categories')->with('category-error', 'Category name already exists!!');
            }

            $category = new Category();

            $category->name = $category_name;
            $category->save();
            // return response()->json(['success' => 'Category has been created successfully']);
            return redirect('/categories')->with('success', 'Category has been created successfully!!');
        } catch (\Exception $e) {
            // return response(500)->json(['error' => 'Something went wrong while creating category. Please try again later']);
            return redirect('/categories')->with('error', 'Something went wrong while creating category. Please try again later!!');
        }
    }

    // Get all categories
    public function getAllCategories()
    {
        $categories = DB::table('categories')
            ->orderByDesc('created_at')
            ->get();

        return view('category.create', compact('categories'));
    }

    // Disabling Category for listing.
    public function changeCategoryStatus(Request $request)
    {
        $categoryId = $request->query('cat_id');
        // $adminId = Auth::user()->id;

        // if (!$adminId) {
        //     return response()->json(['error' => 'You must login to do this']);
        // }

        try {
            $categoryExists = DB::table('categories')
                ->where('id', $categoryId)
                ->first();

            if (!$categoryExists) {
                return redirect('/categories')->with('error', 'Category not found');
            }

            // DB::table('categories')
            //     ->where('id', $categoryId)
            //     ->update(['status' => 0]);

            $category = Category::find($categoryId);

            $category->status = !$category->status;

            $category->save();

            return redirect("/categories")->with('success', 'Disabled categories');
        } catch (\Exception $e) {
            return redirect("/categories")->with('error', 'Something went wrong while disabling category. Please try again later');
        }
    }
}
