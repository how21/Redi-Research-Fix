<?php

use App\Models\Client;
use App\Models\Province;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ExpKategoryController;
use App\Http\Controllers\HomeController;
use App\Models\ExpKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/conduct', function() {
    return view('user.conduct');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.view');

// Route::get('/gallery', function () {return view('user.gallery');});
Route::get('/gallery', [HomeController::class, 'indexGallery'])->name('gallery.view');
Route::get('/album/kategori/{id}', [HomeController::class, 'GalleryCat'])->name('categorie.view');

// Route::get('/publicity', function () {return view('user.publicity');});
Route::get('/publicity', [HomeController::class, 'indexJournal'])->name('publicity.view');
Route::get('/publicity/{id}', [HomeController::class, 'showJournal'])->name('detail.jurnal');

// Route::get('/experiences', function () {return view('user.expert');});
Route::get('/experiences', [HomeController::class, 'indexExp'])->name('experiences.view');
Route::get('/experiences/{id}', [HomeController::class, 'showExp'])->name('detail.experiences');



// Dashboard hanya untuk admin & super_admin
Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


    // Route untuk Projects & Clients (1 View)
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');

    // CRUD Projects
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
    // Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

    // CRUD Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

    // CRUD & View Journal
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
    Route::put('/journal/{id}', [JournalController::class, 'update'])->name('journal.update');
    Route::get('/journal/{id}', [JournalController::class, 'show'])->name('journal.show');
    Route::delete('/journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');

    // CRUD & View experience
    Route::get('/experience', [ExperienceController::class, 'index'])->name('experience.index');
    Route::get('/experience/create', [ExperienceController::class, 'create'])->name('experience.create');
    Route::post('/experience/store', [ExperienceController::class, 'store'])->name('experience.store');
    Route::get('/experience/{slug}', [ExperienceController::class, 'show'])->name('experience.show');
    Route::post('/experience/upload-image', [ExperienceController::class, 'uploadImage'])->name('experience.uploadImage');
    Route::delete('/experience/{id}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
    Route::get('/experience/edit/{id}', [ExperienceController::class, 'edit'])->name('experience.edit');
    Route::put('/experience/update/{id}', [ExperienceController::class, 'update'])->name('experience.update');

    Route::get('/provinces/create', [ProvinceController::class, 'create'])->name('province.create');
    Route::post('/provinces', [ProvinceController::class, 'store'])->name('province.store');
    Route::put('/provinces/{id}', [ProvinceController::class, 'update'])->name('province.update');
    Route::delete('/provinces/{id}', [ProvinceController::class, 'destroy'])->name('province.destroy');

    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::post('/album', [AlbumController::class, 'store'])->name('album.store');
    Route::delete('/album/{id}', [AlbumController::class, 'destroy'])->name('album.destroy');
    Route::get('/album/categories/{id}', [AlbumController::class, 'showCategory'])->name('album.category');

    Route::get('/categories', [CategorieController::class, 'index'])->name('categorie.index');
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categorie.store');
    Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categorie.update');
    Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categorie.destroy');

    Route::get('/bidangs', [ExpKategoryController::class, 'index'])->name('bidang.index');
    Route::get('/bidangs/create', [ExpKategoryController::class, 'create'])->name('bidang.create');
    Route::post('/bidangs', [ExpKategoryController::class, 'store'])->name('bidang.store');
    Route::put('/bidangs/{id}', [ExpKategoryController::class, 'update'])->name('province.update');
    Route::delete('/bidangs/{id}', [ExpKategoryController::class, 'destroy'])->name('bidang.destroy');
});

// Halaman hanya untuk Super Admin
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route view users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

// Profile bisa diakses semua user yang login
Route::middleware('auth')->group(function () {
    // Tambahkan route khusus jika dibutuhkan
});

require __DIR__.'/auth.php';
