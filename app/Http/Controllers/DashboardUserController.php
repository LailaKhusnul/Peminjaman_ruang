<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanUser;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    //
    public function index()
    {
        $data_pinjam = PeminjamanUser::where('user_id', auth()->id())->get();
        return view('user.dashboarduser', compact('data_pinjam'));
    }
}
