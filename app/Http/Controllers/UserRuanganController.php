<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class UserRuanganController extends Controller
{
    //
    public function index(Request $request)
    {
        $data_ruang = new Ruang;

        // Pengecekan apakah ada parameter 'search' dalam request
        if ($request->get('search')) {
            $data_ruang = $data_ruang->where('nama_ruang', 'LIKE', '%' . $request->get('search') . '%')
                ->orWhere('fasilitas', 'LIKE', '%' . $request->get('search') . '%')
                ->orWhere('lokasi', 'LIKE', '%' . $request->get('search') . '%');
        }

        // Mendapatkan semua data ruang setelah kemungkinan filter pencarian
        $data_ruang = $data_ruang->get();

        // Mengembalikan view 'user.ruangan' dengan data_ruang dan request
        return view('user.ruangan', compact('data_ruang', 'request'));
    }
}
