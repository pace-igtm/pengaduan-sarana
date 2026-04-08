<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('login'); // Pastikan buat file login.blade.php nanti
    }

    public function login(Request $request){
        // validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        // 1. Cek Login Siswa (Input username dianggap NIS)
        if (Auth::guard('siswa')->attempt(['nis' => $request-> username, 'password' => $request->password])) {
            return redirect ('/siswa/dashboard');
        }
        // 2. Cek Login ADMIN
        if (Auth::guard('admin')->attempt(['username'=> $request->username, 'password'=>$request->password]))
            {
                return redirect('/admin/dasboard');
                }
                return back()->with('error', 'Login Gagal.Cek Username/NIS dan Password.');
    }
    public function logout(){
        if (Auth::guard('siswa')->check()){
            Auth::guard('siswa')->logout();
        } elseif (Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        return redirect('/login');
    }
}
