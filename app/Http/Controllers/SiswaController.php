<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        // ambil pendaftaran terakhir yang APPROVED
        $langganan = Pendaftaran::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->latest()
            ->first();

        $expiredAt = null;
        $sisaHari = null;

        if ($langganan && $langganan->paket) {

            // ambil angka durasi (contoh: "3 Bulan", "1 Tahun")
            $durasiAngka = (int) filter_var(
                $langganan->paket->durasi,
                FILTER_SANITIZE_NUMBER_INT
            );

            // konversi ke bulan
            if (str_contains(strtolower($langganan->paket->durasi), 'tahun')) {
                $durasiBulan = $durasiAngka * 12;
            } else {
                $durasiBulan = $durasiAngka;
            }

            // hitung expired
            $expiredAt = Carbon::parse($langganan->tanggal_daftar)
                ->addMonths($durasiBulan);

            // cek masih aktif
            if (Carbon::now()->lt($expiredAt)) {
                $sisaHari = Carbon::now()->diffInDays($expiredAt);
            } else {
                // kalau expired → dianggap tidak aktif
                $langganan = null;
            }
        }

        return view('layouts.home', compact(
            'langganan',
            'expiredAt',
            'sisaHari'
        ));
    }
    // tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // proses register siswa
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa', // 👈 PENTING
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    public function profile()
    {
        return view('siswa.profile.index');
    }
}
