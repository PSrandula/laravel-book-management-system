<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:subcategories,name',
            'category_id' => 'required|exists:categories,id',
        ]);
        Subcategory::create($request->only('name', 'category_id'));
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|unique:subcategories,name,' . $subcategory->id,
            'category_id' => 'required|exists:categories,id',
        ]);
        $subcategory->update($request->only('name', 'category_id'));
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated.');
    }

    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->books()->exists()) {
            return redirect()->route('subcategories.index')->withErrors('Cannot delete subcategory with linked books.');
        }
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted.');
    }
}
