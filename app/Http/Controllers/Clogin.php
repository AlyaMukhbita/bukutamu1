<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Clogin extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        // Validasi input login
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
    
        // Ambil kredensial input user
        $credentials = $request->only('username', 'password');
    
        // Autentikasi menggunakan Auth::attempt
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();
    
            // Redirect ke dashboard atau halaman yang diinginkan
            return redirect()->route('dashboard.index');
        }
    
        // Jika login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah',
            'password' => 'Username atau password salah',
        ])  ->onlyInput('username')
            ->onlyInput('password');
    }
    
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Berhasil Logout');
    }


}
