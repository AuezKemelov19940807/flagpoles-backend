<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class CategoryController extends Controller {
    public function index() {
        $categories  = Category::all();
        return response()->json($categories);
    }

    public function create()
    {
         return view('admin.category.create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::create($validatedData);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');

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
