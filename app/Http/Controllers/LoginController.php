<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        // Validasi data
        $request->validate([
            'email'     => 'required|string|email',
            'password'  => 'required|string',
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        // Proses login
        if (Auth::attempt($data)) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if($user->hasRole('admin')) {
                return redirect()->route('dashboard');
            } elseif ($user->hasRole('wadir')) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('dashboarduser');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
        
        // // Proses login mine
        // if(Auth::attempt($data)){       //proses pengecekan login
        //     return redirect()->route('admin.dashboard'); // Ubah 'dashboard' dengan rute yang sesuai
        // }else{
        //     return redirect()->route('login')->with('failed','Email atau Password Salah');
        // }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Kamu Berhasil Logout');
    }

    public function register(){
        return view('auth.register');
    }
}
