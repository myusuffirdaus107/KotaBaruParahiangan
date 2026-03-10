<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display categories.
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.categories.form');
    }

    /**
     * Store category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'slug' => 'required|string|unique:categories|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Show edit form.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update category.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Delete category.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil dihapus');
    }
}
