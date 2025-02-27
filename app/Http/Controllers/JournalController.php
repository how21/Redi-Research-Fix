<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian
        $search = $request->input('search');
    
        // Query journals dengan filter pencarian
        $journals = Journal::when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%")
                            ->orWhere('authors', 'like', "%{$search}%");
            })
            ->orderBy('publication_year', 'desc')
            ->paginate(8); 
    
        return view('journal.index', compact('journals'));
    }

    public function create()
    {
        return view('journal.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:journals,title,',
            'authors' => 'required|string',
            'publication_year' => 'required|integer',
            'publisher' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'file' => 'required|mimes:pdf|max:2048', // Hanya PDF, max 2MB
            'doi' => 'nullable|string|max:255',
            'keyword' => 'nullable|string',
        ]);

        // Simpan file PDF
        $filePath = $request->file('file')->store('journals', 'public');

        // Proses keyword jadi array
        $keywordsArray = $request->keyword ? json_decode($request->keyword, true) : [];
        // Bersihkan spasi berlebih di keyword
        $keywordsArray = array_map('trim', $keywordsArray);

        // Simpan data ke database
        Journal::create([
            'title' => $request->title,
            'authors' => $request->authors,
            'publication_year' => $request->publication_year,
            'publisher' => $request->publisher,
            'abstract' => $request->abstract,
            'file_path' => $filePath, // Simpan path file
            'doi' => $request->doi,
            'keyword' => $keywordsArray,
        ]);

        return redirect()->route('journal.index')->with('success', 'Journal berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $journals = Journal::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255|unique:journals,title,' . $journals->id,
            'authors' => 'required|string',
            'publication_year' => 'required|integer',
            'publisher' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:2048', // Opsional, hanya jika ingin mengganti file
            'doi' => 'nullable|string|max:255',
            'keyword' => 'nullable|string',
        ]);

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($journals->file_path) {
                Storage::disk('public')->delete($journals->file_path);
            }

            // Simpan file PDF baru
            $filePath = $request->file('file')->store('journals', 'public');
            $journals->file_path = $filePath;
        }

        // Proses keyword jadi array
        $keywordsArray = is_array($request->keyword) ? $request->keyword : json_decode($request->keyword, true) ?? [];
        $keywordsArray = array_map('trim', $keywordsArray);        

        // Update data di database
        $journals->update([
            'title' => $request->title,
            'authors' => $request->authors,
            'publication_year' => $request->publication_year,
            'publisher' => $request->publisher,
            'abstract' => $request->abstract,
            'doi' => $request->doi,
            'keyword' => $keywordsArray,
        ]);

        return redirect()->route('journal.index')->with('success', 'Journal berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $journals = Journal::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($journals->file_path) {
            Storage::disk('public')->delete($journals->file_path);
        }

        // Hapus dari database
        $journals->delete();

        return redirect()->route('journal.index')->with('success', 'Journal berhasil dihapus!');
    }

    public function show($id)
    {
        $journals = Journal::findOrFail($id);
    
        // Mengambil maksimal 4 jurnal lainnya selain yang sedang dibuka
        $randomJournals = Journal::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();
    
        return view('journal.show', compact('journals', 'randomJournals'));
    }    
}
