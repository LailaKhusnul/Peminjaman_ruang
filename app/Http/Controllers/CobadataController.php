<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PeminjamanUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CobadataController extends Controller
{
    //
    public function dashboard(){
        //if(auth()->user()->can('view_dashboard')){
            $userCount = User::count();                 // Menghitung total user 
            $totalPeminjaman = PeminjamanUser::count(); // Menghitung total peminjaman
            return view('dashboard', compact('userCount', 'totalPeminjaman'));            
        //}
        //return abort(403);
    }

    public function cobadata(Request $request){
        $data = User::query();

        if($request->has('search')){
            $data->where('name','LIKE','%'.$request->get('search').'%')
            ->orWhere('email','LIKE','%'.$request->get('search').'%');
        }

        $data = $data->get();

        return view('cobadata',compact('data','request'));
    }
    
    public function create(){
        return view('create');
    }

    public function store(Request $request){ 
        $validator = Validator::make($request->all(),[
            'photo'     => 'required|mimes:png,jpg,jpeg|max:2048',
            'email'     => 'required|email',
            'nama'      => 'required',
            'password'  => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        //dd($request->all());

        $photo      = $request->file('photo');
        $filename   = date('Y-m-d').$photo->getClientOriginalName();
        $path       = 'photo-user/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data['email']      = $request->email;          //'email' dari field database tabel user
        $data['name']       = $request->nama;
        $data['password']   = Hash::make($request->password);
        $data['image']      = $filename;

        User::create($data);

        return redirect()->route('admin.index');
    }

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('edit',compact('data'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'photo'     => 'required|mimes:png,jpg,jpeg|max:2048',
            'email'     => 'required|email',
            'nama'      => 'required',
            'password'  => 'nullable',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['email']      = $request->email;
        $data['name']       = $request->nama;

        if($request->password){
            $data['password']   = Hash::make($request->password);
        }

        User::whereId($id)->update($data);

        return redirect()->route('admin.index');
    }
    
    public function delete(Request $request,$id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }
        return redirect()->route('admin.index');
    }

}
