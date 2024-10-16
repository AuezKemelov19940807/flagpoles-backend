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

        return view('admin.category.index', ['category' => Category::all()] );
    }

    public function create()
    {
         return view('admin.category.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = $request->file('image')->getClientOriginalName();

        $imagePath = $request->file('image')->store('images', 'public');

        // Сохранение информации о категории в БД (если нужно)
        $category = new Category();
        $category->title = $request->title;
        $category->image = $imagePath;
        $category->save();

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
