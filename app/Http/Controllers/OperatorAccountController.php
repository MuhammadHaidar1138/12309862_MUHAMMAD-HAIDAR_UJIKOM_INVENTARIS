<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OperatorAccountController extends Controller
{
    public function index()
    {
        $operators = User::where('role', 'staff')->get();

        return view('pages.operator-account.index', compact('operators'));
    }

    public function create()
    {
        return view('pages.operator-account.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff'
        ]);

        return redirect()->route('operator-account.index')
            ->with('success', 'Operator berhasil ditambahkan');
    }

    public function edit($id)
    {
        $operator = User::findOrFail($id);

        return view('pages.operator-account.edit', compact('operator'));
    }

    public function update(Request $request, $id)
    {
        $operator = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $operator->update($data);

        return redirect()->route('operator-account.index')
            ->with('success', 'Operator berhasil diupdate');
    }

    public function destroy($id)
    {
        $operator = User::findOrFail($id);

        if (Auth::check() && $operator->id == Auth::user()->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $operator->delete();

        return redirect()->route('operator-account.index')
            ->with('success', 'Operator berhasil dihapus');
    }
}
