<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminPendaftaranController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftaran::with('user', 'paket')->latest()->get();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function approve($id)
    {
        Pendaftaran::findOrFail($id)->update([
            'status' => 'approved',
            'keterangan' => null
        ]);
        return back()->with('success', 'Pendaftaran diterima');
    }

    public function reject(Request $request, $id)
    {
        Pendaftaran::findOrFail($id)->update([
            'status' => 'rejected',
            'keterangan' => $request->keterangan ?? 'Ditolak admin'
        ]);
        return back()->with('success', 'Pendaftaran ditolak');
    }
    public function detailAdmin($id)
    {
        $pendaftaran = \App\Models\Pendaftaran::with('user')->findOrFail($id);

        return view('admin.pendaftar.detail', compact('pendaftaran'));
    }
    public function detail($id)
    {
        $pendaftaran = Pendaftaran::with('user')->findOrFail($id);

        return view('admin.pendaftar.detail', compact('pendaftaran'));
    }
}
