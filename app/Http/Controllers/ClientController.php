<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Menampilkan semua client
    public function index()
    {
        $clients = Client::all();
        return view('admin.dashboard', compact('clients'));
    }

    // Menyimpan client baru
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255|unique:clients,full_name',
            'short_name' => 'required|string|max:50|unique:clients,short_name',
        ]);

        
        Client::create([
            'full_name' => $request->full_name,
            'short_name' => $request->short_name,
        ]);

        return redirect()->back()->with('success', 'Client berhasil ditambahkan!');
    }

    // Mengupdate client
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255|unique:clients,full_name,' . $id,
            'short_name' => 'required|string|max:50|unique:clients,short_name,' . $id,
        ]);

        $clients = Client::findOrFail($id);
        $clients->update($request->all());
        // $clients->update([
        //     'full_name' => $request->full_name,
        //     'short_name' => $request->short_name,
        // ]);

        return redirect()->back()->with('success', 'Client berhasil diperbarui!');
    }

    public function edit($id)
    {
        $clients = Client::findOrFail($id);
        session()->flash('editMode', true);
        return view('admin.dashboard', compact('clients'));
    }

    // Menghapus client
    public function destroy($id)
    {
        $clients = Client::findOrFail($id);
        $clients->delete();

        return redirect()->back()->with('success', 'Client berhasil dihapus!');
    }
}
