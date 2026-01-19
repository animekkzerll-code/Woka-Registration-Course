<?php

namespace App\Http\Controllers;
use App\Models\Pendaftaran;
use App\Models\Setting;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPendaftar' => Pendaftaran::count(),
            'pending'        => Pendaftaran::where('status', 'pending')->count(),
            'diterima'       => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak'        => Pendaftaran::where('status', 'ditolak')->count(),
            'pendaftaranStatus' => Setting::get('pendaftaran_status')
        ]);
    }

public function togglePendaftaran()
{
    $status = Setting::get('pendaftaran_status');

    $newStatus = $status === 'aktif' ? 'nonaktif' : 'aktif';

    Setting::set('pendaftaran_status', $newStatus);

    return redirect()->back()->with('success', 
        $newStatus === 'aktif'
            ? 'Pendaftaran berhasil diaktifkan'
            : 'Pendaftaran berhasil dinonaktifkan'
    );
}

}

