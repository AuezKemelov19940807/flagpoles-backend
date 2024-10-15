<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index() {
        $categories  = Category::all();
        return response()->json($categories);
    }

    public function show($category)
    {
        // You can fetch the category from the database using the parameter
        $categoryData = Category::where('slug', $category)->orWhere('id', $category)->first();

        if ($categoryData) {
            return response()->json($categoryData, 200);
        }

        return response()->json(['error' => 'Category not found'], 404);
    }




}
