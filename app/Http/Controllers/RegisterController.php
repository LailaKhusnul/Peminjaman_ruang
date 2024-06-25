<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    //
    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_type' => 'required|string|in:dosen,mahasiswa' // Validasi role        
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_type' => $request->role_type,
        ]);

        //s $data['name']       = $request->nama;
        //s $data['email']      = $request->email;
        //s $data['password']   = Hash::make($request->password);
        
        
        //s User::create($data);

        // $login = [
        //     'email'     => $request->email,
        //s     'password'  => Hash::make($request->password),
        //s ];
        
        // Assign role ke user
        $user->assignRole($request->role_type);

        // Login user
        Auth::login($user);

        // Redirect berdasarkan role
        if($user->hasRole('dosen') || $user->hasRole('mahasiswa')){
            return redirect()->route('dashboarduser');
        } else {
            return redirect()->route('admin.dashboard');
        }

        // // Proses login
        // if(Auth::attempt($login)){
        //     return redirect()->route('admin.dashboard'); // Ubah 'dashboard' dengan rute yang sesuai
        // }else{
        //     return redirect()->route('login')->with('success', 'Registrasi Berhasil! Silakan Login.');      // Notifikasi berhasil dan redirect ke halaman login
        //     // return redirect()->route('login')->with('failed','Email atau Password Salah');
        // }

    }
}
