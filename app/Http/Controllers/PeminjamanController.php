<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanUser;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    // function peminjaman
    public function peminjaman(Request $request){
        $data_pinjam = PeminjamanUser::with(['user', 'ruang'])->get();

        if ($request->get('export') == 'pdf'){
            $logo_path = public_path('images/logo_poltek.png');
            $logo_base64 = base64_encode(file_get_contents($logo_path));

            $pdf = Pdf::loadView('pdf.peminjaman-admin', [
                'data_pinjam' => $data_pinjam,
                'logo_base64' => $logo_base64
            ]);
            return $pdf->stream('Data Peminjaman.pdf');
        }
        return view('admin.peminjaman.index',compact('data_pinjam', 'request'));
    }
    
    public function create(){
        return view('admin.create');
    }

    // View admin peminjaman
    public function index()
    {
        $data_pinjam = PeminjamanUser::with(['user', 'ruang'])->where('status', 'pending')->get();
        return view('admin.peminjaman.index', compact('data_pinjam'));
    }

    public function approve($id)
    {
        $data_pinjam = PeminjamanUser::find($id);
        $data_pinjam->status = 'approved';
        $data_pinjam->save();
        return redirect()->route('peminjaman.index2')->with('success', 'Peminjaman disetujui.');
    }

    public function reject($id)
    {
        $data_pinjam = PeminjamanUser::find($id);
        $data_pinjam->status = 'rejected';
        $data_pinjam->save();
        return redirect()->route('peminjaman.index2')->with('success', 'Peminjaman ditolak.');
    }
}
