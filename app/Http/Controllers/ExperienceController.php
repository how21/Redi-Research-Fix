<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Client;
use App\Models\Province;
use App\Models\ExpKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    public function create()
    {
        $clients = Client::orderBy('full_name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();
        $bidangs = ExpKategori::orderBy('name', 'asc')->get();
    
        return view('experience.create', compact('clients', 'provinces', 'bidangs'));
    }

    public function store(Request $request)
    {
        Image::configure(['driver' => 'gd']);
        ini_set('memory_limit', '2048M');

        $slug = Str::slug($request->title);

        if (Experience::where('slug', $slug)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['title' => 'Judul sudah digunakan, coba judul lain.']);
        }

        // Validasi input
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'client_id' => 'required|exists:clients,id',
            'province_id' => 'required|exists:provinces,id',
            'kategori_id' => 'required|exists:exp_kategori,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'desc' => 'nullable|string', // Trix menyimpan HTML dalam string
        ]);

        // **UPLOAD GAMBAR JIKA ADA**
        $storagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

                // Simpan gambar utama menggunakan GD
                Image::make($file)
                    ->resize(1440, 720)
                    ->save(public_path("storage/experiences/" . $fileName));

            $storagePath = "storage/experiences/". $fileName;
        }

        // Simpan ke database
        Experience::create([
            'title' => $request->title,
            'slug' => $slug,
            'client_id' => $request->client_id,
            'province_id' => $request->province_id,
            'kategori_id' => $request->kategori_id,
            'image' => $storagePath,
            'desc' => $request->desc, // Trix hanya menyimpan HTML teks biasa
        ]);

        return redirect()->route('experience.index')->with('success', 'Experience berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $experiences = Experience::findOrFail($id);
        $clients = Client::all();
        $provinces = Province::all();
        $bidangs = ExpKategori::all();
        return view('experience.edit', compact('experiences', 'clients', 'provinces', 'bidangs'));
    }

    public function update(Request $request, $id)
    {
        $experiences = Experience::findOrFail($id);

        $slug = Str::slug($request->title);

        // Cek apakah slug sudah ada tapi bukan milik yang sedang diedit
        if (Experience::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['title' => 'Judul sudah digunakan, coba judul lain.']);
        }

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'province_id' => 'required|exists:provinces,id',
            'kategori_id' => 'required|exists:exp_kategori,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'desc' => 'nullable|string', // Menyimpan HTML dari Trix
        ]);

        // **UPLOAD GAMBAR JIKA ADA**
        // $storagePath = $experiences->image; belum perlu
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

                // Simpan gambar utama menggunakan GD
                Image::make($file)
                    ->resize(1440, 720)
                    ->save(public_path("storage/experiences/" . $fileName));

            if ($experiences->image && file_exists(public_path($experiences->image))) {
                unlink(public_path($experiences->image));
            }

            $experiences->image = "storage/experiences/" . $fileName;
        }

        // Update data experience
        $experiences->update([
            'title' => $request->title,
            'slug' => $slug,
            'client_id' => $request->client_id,
            'province_id' => $request->province_id,
            'kategori_id' => $request->kategori_id,
            'image' => $experiences->image,
            'desc' => $request->desc, // Tetap menyimpan teks HTML dari Trix
        ]);

        return redirect()->route('experience.index')->with('success', 'Experience berhasil diperbarui!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('trix-images', $fileName, 'public'); 

            return response()->json(['url' => asset("storage/" . $path)]);
        }

        return response()->json(['error' => 'Upload gagal'], 400);
    }     

    public function destroy($id)
    {
        $experiences = Experience::findOrFail($id);

        // Hapus gambar jika ada
        if ($experiences->image && file_exists(public_path($experiences->image))) {
            unlink(public_path($experiences->image));
        }

        $experiences->delete();

        return redirect()->route('experience.index')->with('success', 'Experience berhasil dihapus!');
    }        

    public function index(Request $request)
    {
        $query = Experience::query();
    
        // Simpan filter ke variabel
        $client_id = $request->query('client_id'); 
        $province_id = $request->query('province_id');
        $kategori_id = $request->query('kategori_id');
        $searchExperience = $request->query('searchExperience');
    
        // Filter berdasarkan client_id jika ada
        if ($request->filled('client_id')) {
            $query->where('client_id', $client_id);
        }

        // Filter berdasarkan province_id jika ada
        if ($request->filled('province_id')) {
            $query->where('province_id', $province_id);
        }

        // Filter berdasarkan kategori_id jika ada
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $kategori_id);
        }
    
        // Pencarian berdasarkan title
        if (!empty($searchExperience)) {
            $query->where('title', 'like', '%' . $searchExperience . '%');
        }
    
        // Ambil data dengan pagination
        $experiences = $query
                    ->orderBy('id', 'desc')
                    ->paginate(9, ['*'], 'exp_page')->appends($request->query());
    
        // Ambil semua clients & bidangs untuk dropdown filter
        $clients = Client::all();
        $provinces = Province::all();
        $bidangs = ExpKategori::all();
    
        return view('experience.index', compact('experiences', 'clients', 'provinces','bidangs', 'searchExperience', 'client_id', 'province_id', 'kategori_id'));
    } 

    // public function index(Request $request) 
    // {
    //     $query = Experience::query();
    
    //     // Filter berdasarkan client_id jika ada
    //     if ($request->has('client_id') && $request->client_id) {
    //         $query->where('client_id', $request->client_id);
    //     }
    
    //     // Filter berdasarkan province_id jika ada
    //     if ($request->has('province_id') && $request->province_id) {
    //         $query->where('province_id', $request->province_id);
    //     }

    //     // Filter berdasarkan province_id jika ada
    //     if ($request->has('kategori_id') && $request->kategori_id) {
    //         $query->where('kategori_id', $request->kategori_id);
    //     }
    
    //     // Ambil data experiences sesuai filter dan paginasi
    //     $experiences = $query->orderBy('id', 'desc')->paginate(9);
    
    //     // Ambil data clients dan provinces untuk dropdown filter
    //     $clients = Client::all();
    //     $provinces = Province::all();
    //     $bidangs =ExpKategori::all();
    
    //     return view('experience.index', compact('experiences', 'clients', 'provinces', 'bidangs'));
    // }

    public function show($id)
    {
        $experiences = Experience::findOrFail($id);
    
        // Ambil related experiences berdasarkan client atau province yang sama
        $relatedExperiences = Experience::where(function ($query) use ($experiences) {
                $query->where('kategori_id', $experiences->client_id);
            })
            ->where('id', '!=', $experiences->id) // Jangan tampilkan yang sedang dibuka
            ->take(4)
            ->get();
    
        // Jika related experiences kurang dari 4, ambil tambahan random experiences
        $randomExperiences = collect(); // Inisialisasi collection kosong
    
        if ($relatedExperiences->count() < 4) {
            $randomExperiences = Experience::where('id', '!=', $experiences->id)
                ->whereNotIn('id', $relatedExperiences->pluck('id')) // Hindari duplikasi
                ->inRandomOrder()
                ->take(4 - $relatedExperiences->count())
                ->get();
        }
    
        return view('experience.show', compact('experiences', 'relatedExperiences', 'randomExperiences'));
    }
    

}

