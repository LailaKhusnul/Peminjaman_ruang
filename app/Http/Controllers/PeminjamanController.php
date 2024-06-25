<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanUser;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    // coba data
    public function peminjaman(Request $request){
        $data_pinjam = PeminjamanUser::get();

        if ($request->get('export') == 'pdf'){
            $pdf = Pdf::loadView('pdf.peminjaman-admin', ['data_pinjam' => $data_pinjam]);
            return $pdf->stream('Data Peminjaman.pdf');
        }
        return view('admin.peminjaman.index',compact('data_pinjam', 'request'));
    }
    
    public function create(){
        return view('admin.create');
    }

    public function index()
    {
        $peminjaman = PeminjamanUser::with(['user', 'ruang'])->where('status', 'pending')->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function approve($id)
    {
        $peminjaman = PeminjamanUser::find($id);
        $peminjaman->status = 'approved';
        $peminjaman->save();
        return redirect()->route('peminjaman.index2')->with('success', 'Peminjaman disetujui.');
    }

    public function reject($id)
    {
        $peminjaman = PeminjamanUser::find($id);
        $peminjaman->status = 'rejected';
        $peminjaman->save();
        return redirect()->route('peminjaman.index2')->with('success', 'Peminjaman ditolak.');
    }
}
