<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // SET SESSION UNTUK ANIMASI LOGIN
            session()->flash('login_success', true);

            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard'); 
            } else {
                return redirect('/'); 
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register'); // buat view register.blade.php
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa', // default role
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }
}
