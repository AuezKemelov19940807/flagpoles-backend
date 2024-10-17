<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index() {

        return view('admin.category.index', ['category' => Category::all(), 'catalogs' => Catalog::all()]);
    }

    public function create()
    {
        return view('admin.category.create' , ['catalogs' => Catalog::all()]);
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'catalog_id' => 'required|exists:catalogs,id',
        ]);

        $category = new Category();
        $category->name  = $request->name;
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('uploads/categories', 'public');
            $category->image = $imagePath;
        }

        $category->catalog_id = $request->catalog_id;
        $category->slug = \Illuminate\Support\Str::slug($request->name);

        $catalog = Catalog::find($category->catalog_id);

        $category->save();
        return redirect()->route('admin.category.index')->with([
            'success' => 'Catalog created successfully.',
            'catalog' => $catalog, // Передаем связанный каталог
            'category' => $category // Можно также передать саму категорию, если нужно
        ]);
    }

    public function show($category)
    {

        $categoryData = Category::where('slug', $category)->orWhere('id', $category)->first();

        if ($categoryData) {
            return response()->json($categoryData, 200);
        }

        return response()->json(['error' => 'Category not found'], 404);
    }


}
