<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.dashboard', compact('categories'));
    }

    // Menyimpan Categories baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Client berhasil ditambahkan!');
    }

    // Mengupdate 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = Category::findOrFail($id);
        $categories->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Client berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->back()->with('success', 'Client berhasil dihapus!');
    }
    
}