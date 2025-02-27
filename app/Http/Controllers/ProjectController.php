<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\ExpKategori;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();
    
        // Simpan filter ke variabel
        $client_id = $request->query('client_id'); 
        $kategori_id = $request->query('kategori_id');
        $searchProject = $request->query('searchProject');
    
        // Filter berdasarkan client_id jika ada
        if ($request->filled('client_id')) {
            $query->where('client_id', $client_id);
        }
    
        // Filter berdasarkan kategori_id jika ada
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $kategori_id);
        }
    
        // Pencarian berdasarkan title
        if (!empty($searchProject)) {
            $query->where('title', 'like', '%' . $searchProject . '%');
        }
    
        // Ambil data dengan pagination
        $projects = $query
                    ->orderBy('date', 'desc')
                    ->paginate(10, ['*'], 'project_page')->appends($request->query());
    
        // Ambil semua clients & bidangs untuk dropdown filter
        $clients = Client::all();
        $bidangs = ExpKategori::all();
    
        return view('admin.project', compact('projects', 'clients', 'bidangs', 'searchProject', 'client_id', 'kategori_id'));
    }         

    public function create()
    {
        $clients = Client::all();
        $bidangs = ExpKategori::all(); 

        return view('admin.project', compact('clients', 'bidangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:projects,title',
            'date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'kategori_id' => 'required|exists:exp_kategori,id',
        ]);
    
        Project::create([
            'title' => $request->title,
            'date' => $request->date,
            'client_id' => $request->client_id,
            'kategori_id' => $request->kategori_id,
        ]);
    
        return redirect()->back()->with('success', 'Project berhasil ditambahkan!');
    }
    
    public function destroy($id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();
    
        return redirect()->back()->with('success', 'Project berhasil dihapus!');
    }

}
