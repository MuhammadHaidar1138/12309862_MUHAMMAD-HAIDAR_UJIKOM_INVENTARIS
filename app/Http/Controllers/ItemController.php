<?php

namespace App\Http\Controllers;

use App\Exports\ItemExport;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();

        return view('pages.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'total_stock' => 'required|integer|min:0',
        ]);

        Item::create([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'total_stock' => $request->total_stock,
            'total_repaired' => 0,
            'total_borrowed' => 0,
        ]);

        return redirect()->route('item.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('pages.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'total_stock' => 'required|integer|min:0',
        ]);

        $item = Item::findOrFail($id);

        $item->update([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'total_stock' => $request->total_stock,
        ]);

        return redirect()->route('item.index')
            ->with('success', 'Item berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('item.index')
            ->with('success', 'Item berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new ItemExport, 'items.xlsx');
    }
}
