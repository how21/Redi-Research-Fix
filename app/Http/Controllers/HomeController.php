<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Journal;
use App\Models\Client;
use App\Models\Province;
use App\Models\Experience;
use App\Models\ExpKategori;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $projectsByCategory = Project::selectRaw('kategori_id, COUNT(*) as total')
            ->groupBy('kategori_id')
            ->with('bidang') // Pastikan relasi 'kategori' ada di model Project
            ->get();

        // Ambil jumlah proyek per tahun
        $projectsByYear = Project::selectRaw('YEAR(date) as year, COUNT(*) as total')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        $totalClients = Client::count(); 
        $totalProjects = Project::count();

        return view('user.main', compact('totalClients', 'totalProjects', 'projectsByCategory', 'projectsByYear'));
    }

    public function indexGallery()
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
    
        return view('user.gallery', compact('sliderImages', 'categories'));
    }

    public function GalleryCat($id)
    {
        // Ambil kategori berdasarkan ID
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->route('categorie.view')->with('error', 'Kategori tidak ditemukan.');
        }
    
        // Ambil album dengan pagination dan urutkan berdasarkan ID secara descending
        $albums = $category->albums()->orderBy('id', 'desc')->paginate(12);
    
        // Kirim variabel $albums meskipun kosong
        return view('user.album', compact('category', 'albums'))->with('message', $albums->isEmpty() ? 'Belum ada album dalam kategori ini.' : null);
    }
    

    public function indexJournal(Request $request)
    {
        // Ambil query pencarian
        $search = $request->input('search');
    
        // Query journals dengan filter pencarian
        $journals = Journal::when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%")
                            ->orWhere('authors', 'like', "%{$search}%");
            })
            ->orderBy('publication_year', 'desc')
            ->paginate(9); // Pagination 10 data per halaman
    
        return view('user.publicity', compact('journals'));
    }

    public function showJournal($id)
    {
        $journals = Journal::findOrFail($id);
    
        // Mengambil maksimal 4 jurnal lainnya selain yang sedang dibuka
        $randomJournals = Journal::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();
    
        return view('user.showPublicity', compact('journals', 'randomJournals'));
    }

    public function indexExp(Request $request)
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
    
        return view('user.expert', compact('experiences', 'clients', 'provinces','bidangs', 'searchExperience', 'client_id', 'province_id', 'kategori_id'));
    }

    
    public function showExp($id)
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
    
        return view('user.showExp', compact('experiences', 'relatedExperiences', 'randomExperiences'));
    }
}
