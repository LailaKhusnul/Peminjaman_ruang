<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{
    //
    public function ruangan(Request $request){
        $data_ruang = new Ruang;

        if($request->get('search')){
            $data_ruang = $data_ruang->where('nama_ruang','LIKE','%'.$request->get('search').'%')
            ->orWhere('fasilitas','LIKE','%'.$request->get('search').'%')
            ->orWhere('lokasi','LIKE','%'.$request->get('search').'%');
        }

        $data_ruang = $data_ruang->get();

        return view('admin.ruangan',compact('data_ruang','request'));
    }
    
    public function create(){
        
        return view('admin.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama'     => 'required',
            'fasilitas'  => 'required',
            'lokasi'      => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data_ruang['nama_ruang'] = $request->nama;
        $data_ruang['fasilitas']  = $request->fasilitas;
        $data_ruang['lokasi']     = $request->lokasi;

        Ruang::create($data_ruang);

        return redirect()->route('ruangan.index');
    }

    public function edit(Request $request,$id){
        $data_ruang = Ruang::find($id);

        return view('admin.edit',compact('data_ruang'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'nama'      => 'required',
            'fasilitas' => 'required',
            'lokasi'    => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data_ruang['nama_ruang']      = $request->nama;
        $data_ruang['fasilitas']       = $request->fasilitas;
        $data_ruang['lokasi']       = $request->lokasi;

        Ruang::whereId($id)->update($data_ruang);

        return redirect()->route('ruangan.index');
    }
    
    public function delete(Request $request,$id){
        $data_ruang = Ruang::find($id);

        if($data_ruang){
            $data_ruang->delete();
        }
        return redirect()->route('ruangan.index');
    }
}
