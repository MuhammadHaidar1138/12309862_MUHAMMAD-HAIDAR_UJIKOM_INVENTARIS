<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    public function index()
    {
        // Mengambil semua data lending beserta relasi item-nya (Eager Loading)
        // latest() digunakan agar data terbaru muncul di paling atas
        $lendings = Lending::with('item')->latest()->get();

        // Kirim variabel $lendings ke folder resources/views/pages/lending/index.blade.php
        return view('pages.lending.index', compact('lendings'));
    }

    public function create()
    {
        // 1. Ambil semua data barang (Item) untuk dipilih di dropdown
        $items = Item::all();

        // 2. Pastikan nama variabel di compact sama dengan nama variabel di atas ($items)
        return view('pages.lending.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'person_name' => 'required',
            'item_id'     => 'required|array',
            'total'       => 'required|array',
            'staff_name' => 'required|string',
        ]);

        foreach ($request->item_id as $index => $itemId) {
            $qtyRequested = $request->total[$index];
            $item = Item::find($itemId);

            $availableStock = $item->total_stock - $item->total_borrowed;

            if ($qtyRequested > $availableStock) {
                return back()->withErrors("Stok {$item->item_name} tidak mencukupi!")->withInput();
            }

            Lending::create([
                'item_id'     => $itemId,
                'qty'         => $qtyRequested,
                'person_name' => $request->person_name,
                'staff_name' => $request->staff_name,
                'description' => $request->description,
                'date'        => now(),
                'is_returned' => false,
            ]);
            $item->increment('total_borrowed', $qtyRequested);
        }

        return redirect()->route('lending.index')->with('success', 'Data berhasil disimpan!');
    }

    public function returnItem(Request $request, $id)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
        ]);

        $lending = Lending::findOrFail($id);

        $lending->update([
            'is_returned' => true,
            'receiver_name' => $request->receiver_name,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil dikembalikan!');
    }

    public function destroy($id)
    {
        $lending = Lending::findOrFail($id);
        $lending->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
