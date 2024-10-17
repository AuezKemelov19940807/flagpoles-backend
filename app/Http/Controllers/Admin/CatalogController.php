<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class CatalogController extends Controller {


    public function index() {
        return view('admin.catalog.index', ['catalog' => Catalog::all()]);
    }

    public function create()
    {
         return view('admin.catalog.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'description' => 'required|string',
        ]);
        $catalog = new Catalog();
        $catalog->title = $request->title;
        $catalog->subtitle = $request->subtitle;
        $catalog->description = $request->description;

        $catalog->save();
        return redirect()->route('admin.catalog.index')->with('success', 'catalog created successfully.');
    }

    public function show($catalog)
    {
        // You can fetch the category from the database using the parameter
        $catalogData = Catalog::where('slug', $catalog)->orWhere('id', $catalog)->first();

        if ($catalogData) {
            return response()->json($catalogData, 200);
        }

        return response()->json(['error' => 'Catalog not found'], 404);
    }
}
