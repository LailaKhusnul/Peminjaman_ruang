<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanUser;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    // User
    public function index()
    {
        $data_pinjam = PeminjamanUser::where('user_id', auth()->id())->get();
        return view('user.dashboarduser', compact('data_pinjam'));
    }

    // Admin
    public function datacount()
    {
        $userCount = User::count();                 // Menghitung total user
        $totalPeminjaman = PeminjamanUser::count(); // Menghitung total peminjaman
        return view('dashboard', compact('userCount', 'totalPeminjaman'));
    }
}
