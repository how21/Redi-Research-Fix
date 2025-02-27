<?php

namespace App\Http\Controllers;

use App\Models\ExpKategori;
use Illuminate\Http\Request;

class ExpKategoryController extends Controller
{
    public function index()
    {
        $bidangs = ExpKategori::all();
        
        return view('admin.dashboard', compact('bidangs'));
    }

    // Menyimpan Bidang baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:exp_kategori,name',
        ]);

        ExpKategori::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Bidang berhasil ditambahkan!');
    }

    // Mengupdate bidang
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bidangs = ExpKategori::findOrFail($id);
        $bidangs->update([
            'name' => $request->name
        ]);

        return redirect()->route('dashboard')->with('success', 'Bidang berhasil diperbarui!');
    }

    // Menghapus bidang
    public function destroy($id)
    {
        $bidangs = ExpKategori::findOrFail($id);
        $bidangs->delete();

        return redirect()->back()->with('success', 'Bidang berhasil dihapus!');
    }
}
