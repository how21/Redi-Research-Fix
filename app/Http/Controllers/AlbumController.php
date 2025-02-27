<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function create()
    {
        $albums = Album::all();
        $categories = Category::all();
        return view('album', compact('albums', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories_image', 'public');
        }

        Album::create([
            'title' => $request->title,
            'categories_id' => $request->categories_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('album.index')->with('success', 'Content successfully added!');
    }

    public function index()
    {
        // Ambil semua album untuk slider (acak), jika kosong berikan array kosong
        $sliderImages = Album::inRandomOrder()->limit(5)->get();
        if ($sliderImages->isEmpty()) {
            $sliderImages = collect(); // Menghindari error
        }
    
        // Ambil 5 kategori dengan gambar pertama mereka, jika albums kosong tetap lanjut
        $categories = Category::with(['albums' => function ($query) {
            $query->limit(1);
        }])->limit(5)->get();
    
        return view('album.index', compact('sliderImages', 'categories'));
    }

    public function showCategory($id)
    {
        // Ambil kategori berdasarkan ID
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->route('album.index')->with('error', 'Kategori tidak ditemukan.');
        }
    
        // Ambil album dengan pagination
        $albums = $category->albums()->paginate(6);
    
        // Kirim variabel $albums meskipun kosong
        return view('album.categorie', compact('category', 'albums'))->with('message', $albums->isEmpty() ? 'Belum ada album dalam kategori ini.' : null);
    }
    
    public function destroy($id)
    {
        $albums = Album::find($id);

        if (!$albums) {
            return redirect()->back()->with('error', 'Album tidak ditemukan.');
        }

        // Hapus gambar dari storage jika ada
        if ($albums->image) {
            Storage::disk('public')->delete($albums->image);
        }

        $albums->delete();

        return redirect()->back()->with('success', 'Album berhasil dihapus.');
    }

}
