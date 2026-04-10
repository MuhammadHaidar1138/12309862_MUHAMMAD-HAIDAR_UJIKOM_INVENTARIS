<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAccountController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();

        return view('pages.admin-accounts.index', compact('admins'));
    }

    public function create()
    {
        return view('pages.admin-accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin-account.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);

        return view('pages.admin-accounts.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin-account.index')
            ->with('success', 'Admin berhasil diupdate');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        if (Auth::check() && $admin->id == Auth::user()->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $admin->delete();

        return redirect()->route('admin-account.index')
            ->with('success', 'Admin berhasil dihapus');
    }
}
