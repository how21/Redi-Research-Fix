<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Experience;
use App\Models\Album;
use App\Models\Journal;
use App\Models\Client;
use App\Models\Province;
use App\Models\ExpKategori;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $searchClient = $request->query('searchClient');
        $searchProvince = $request->query('searchProvince');
        $searchCategory = $request->query('searchCategory');
        $searchBidang = $request->query('searchBidang');

        // Clients Search
        $clients = Client::when($searchClient, function ($query) use ($searchClient) {
            return $query->where('full_name', 'like', "%{$searchClient}%")
                        ->orWhere('short_name', 'like', "%{$searchClient}%");
            }) // ✅ Tambahkan penutup kurung di sini
            ->orderBy('full_name')
            ->paginate(5, ['*'], 'clients_page')
            ->appends($request->query()); 
        
        // Provinces Search
        $provinces = Province::query()
            ->when($searchProvince, fn($query) => 
                $query->where('name', 'like', "%$searchProvince%")
            )
            ->orderBy('name')
            ->paginate(5, ['*'], 'provinces_page')
            ->appends($request->query());

        // category Search
        $category = Category::query()
            ->when($searchCategory, fn($query) => 
                $query->where('name', 'like', "%$searchCategory%")
            )
            ->orderBy('name')
            ->paginate(5, ['*'], 'category_page')
            ->appends($request->query());

        // bidang Search
        $bidangs = ExpKategori::query()
            ->when($searchBidang, fn($query) => 
                $query->where('name', 'like', "%$searchBidang%")
            )
            ->orderBy('name')
            ->paginate(5, ['*'], 'bidang_page')
            ->appends($request->query());

        return view('admin.dashboard', compact(
            'clients', 'provinces', 'category','bidangs','searchClient', 'searchProvince', 'searchCategory','searchBidang'
        ))->with([
            'totalProjects'   => Project::count(),
            'totalExperiences'=> Experience::count(),
            'totalAlbums'     => Album::count(),
            'totalJournal'    => Journal::count(),
            'totalClients'    => Client::count(),
        ]);
    }    
}
