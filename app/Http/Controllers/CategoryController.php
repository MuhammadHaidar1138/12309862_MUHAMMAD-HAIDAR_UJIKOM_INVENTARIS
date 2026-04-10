<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withSum('items', 'total_stock')->get();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'division_pj' => 'required',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'division_pj' => $request->division_pj,
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'division_pj' => 'required',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'category_name' => $request->category_name,
            'division_pj' => $request->division_pj,
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category berhasil diupdate');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category berhasil dihapus');
    }
}
