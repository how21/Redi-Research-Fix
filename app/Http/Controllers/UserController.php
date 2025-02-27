<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User dimuat
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Ambil semua user kecuali yang sedang login
        return view('admin.user', compact('users'));
    }

    /**
     * Menghapus pengguna berdasarkan ID.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan.');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
