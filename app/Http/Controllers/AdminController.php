<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataBahan;
use Illuminate\Http\Request;
use App\Models\RekomendasiUser;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        $userCount = User::count();
        $menuCount = DataBahan::count();
       $calcCount = RekomendasiUser::count();

        return view('admin.dashboard', compact('userCount', 'menuCount', 'calcCount'));
    }

    /* =============================
     * KELOLA PENGGUNA
     * ============================= */
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }

    /* =============================
     * KELOLA MENU MAKANAN (DataBahan)
     * ============================= */
    public function manageMenu(Request $request)
{
    $search = $request->input('search');

    $menus = DataBahan::when($search, function ($query, $search) {
        return $query->where('bahan', 'like', "%{$search}%");
    })->get();

    return view('admin.manage-menu', compact('menus'));
}


    public function createMenu()
    {
        return view('admin.create-menu');
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'bahan' => 'required|string|max:255',
            'energi' => 'required|numeric',
            'protein' => 'required|numeric',
            'lemak' => 'required|numeric',
            'karbo' => 'required|numeric',
            'serat' => 'required|numeric',
        ]);

        DataBahan::create($request->all());

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function editMenu($id)
    {
        $menu = DataBahan::findOrFail($id);
        return view('admin.edit-menu', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        $request->validate([
            'bahan' => 'required|string|max:255',
            'energi' => 'required|numeric',
            'protein' => 'required|numeric',
            'lemak' => 'required|numeric',
            'karbo' => 'required|numeric',
            'serat' => 'required|numeric',
        ]);

        $menu = DataBahan::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroyMenu($id)
    {
        $menu = DataBahan::findOrFail($id);
        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }
}
