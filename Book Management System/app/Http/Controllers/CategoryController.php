<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:categories,name']);
        Category::create($request->only('name'));
        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|unique:categories,name,' . $category->id]);
        $category->update($request->only('name'));
        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        if ($category->subcategories()->exists()) {
            return redirect()->route('categories.index')->withErrors('Cannot delete category with subcategories.');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}
