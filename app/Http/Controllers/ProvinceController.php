<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        
        return view('admin.dashboard', compact('provinces'));
    }

    // Menyimpan provinsi baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:provinces,name',
        ]);

        Province::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Provinsi berhasil ditambahkan!');
    }

    // Mengupdate client
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $provinces = Province::findOrFail($id);
        $provinces->update([
            'name' => $request->name
        ]);

        return redirect()->route('dashboard')->with('success', 'Provinsi berhasil diperbarui!');
    }

    // Menghapus client
    public function destroy($id)
    {
        $provinces = Province::findOrFail($id);
        $provinces->delete();

        return redirect()->back()->with('success', 'Provinsi berhasil dihapus!');
    }
}
