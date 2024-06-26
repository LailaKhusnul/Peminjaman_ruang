<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanUser;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanUserController extends Controller
{
    public function dashboarduser(){
        //if(auth()->user()->can('view_dashboard')){
            return view('user.dashboarduser');            
        //}
        //return abort(403);
    }

    public function peminjamanuser(){     
        // Mengambil semua data peminjaman bersama dengan data user dan ruang              
        $data_pinjam = PeminjamanUser::with('user', 'ruang')->get();           /* mengambil data tabel peminjamanruang dengan model PeminjamanUser*/
        $data_ruang = Ruang::all();
        
        // Mengirim data ke view
        return view('user.peminjaman.index',compact('data_pinjam', 'data_ruang'));
    }

    // public function filter(Request $request)
    // {
    //     $date = $request->input('date');
    //     $filterType = $request->input('filterType');

    //     if ($filterType == 'available') {
    //         $ruanganKosong = Ruang::whereDoesntHave('peminjaman', function($query) use ($date) {
    //             $query->whereDate('tanggal_mulai', '<=', $date)
    //                 ->whereDate('tanggal_selesai', '>=', $date);
    //         })->get();

    //         return view('user.peminjaman.index', ['data_pinjam' => $ruanganKosong, 'filterType' => $filterType]);
    //     } elseif ($filterType == 'booked') {
    //         $ruanganDipinjam = PeminjamanUser::whereDate('tanggal_mulai', '<=', $date)
    //                                         ->whereDate('tanggal_selesai', '>=', $date)
    //                                         ->with('ruang', 'user')
    //                                         ->get();

    //         return view('user.peminjaman.index', ['data_pinjam' => $ruanganDipinjam, 'filterType' => $filterType]);
    //     }

    //     return redirect()->route('peminjaman.index');
    // }

    // 
    public function index()
    {
        $data_pinjam = PeminjamanUser::where('user_id', auth()->id())->with(['ruang'])->get();
        return view('user.peminjaman.index', compact('peminjaman'));
    }

    public function create(){
        return view('user.peminjaman.create', );
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'id_ruang'          => 'required|exists:ruang,id',               // Pastikan id_ruang ada di tabel ruang
            'user_id'          => 'required',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
            'kegiatan'          => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data_pinjam['user_id'] = auth()->id();
        $data_pinjam['id_ruang'] = $request->id_ruang;
        $data_pinjam['tanggal_mulai']  = $request->tanggal_mulai;
        $data_pinjam['tanggal_selesai']  = $request->tanggal_selesai;
        $data_pinjam['kegiatan']     = $request->kegiatan;
        $data_pinjam['status']     = 'pending';

        PeminjamanUser::create($data_pinjam);

        return redirect()->route('peminjamanuser.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function edit($id){
        $data_pinjam = PeminjamanUser::find($id);
        $data_ruang = Ruang::all();

        return view('user.peminjaman.edit',compact('data_pinjam','data_ruang'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'id_ruang'          => 'required|exists:ruang,id',  // Pastikan id_ruang ada di tabel ruang
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
            'kegiatan'          => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data_pinjam = PeminjamanUser::find($id);
        $data_pinjam->id_ruang = $request->id_ruang;
        $data_pinjam->tanggal_mulai = $request->tanggal_mulai;
        $data_pinjam->tanggal_selesai = $request->tanggal_selesai;
        $data_pinjam->kegiatan = $request->kegiatan;
        $data_pinjam->save();

        return redirect()->route('peminjamanuser.index');
    }
    
    public function delete($id){
        $data_pinjam = PeminjamanUser::find($id);

        if($data_pinjam){
            $data_pinjam->delete();
        }
        return redirect()->route('peminjamanuser.index');
    }
}
