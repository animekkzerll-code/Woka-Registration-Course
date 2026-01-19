<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pricelist;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Jangan lupa import Carbon


class PendaftaranController extends Controller
{

    public function index()
    {
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())->first();
        return view('siswa.pendaftaran.index', compact('pendaftaran'));
    }

    public function create(Request $request)

    {
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->latest()
            ->first();

        // Ambil paket aktif
        $pricelists = Pricelist::where('is_active', 1)->get();
        $pakets = $pricelists->groupBy('nama_paket');

        // Cek status pendaftaran global
        if (Setting::get('pendaftaran_status') !== 'aktif') {
            return view('siswa.pendaftaran.create', compact('pendaftaran', 'pakets'))
                ->with('error', 'Pendaftaran belum dibuka.');
        }

        if ($pendaftaran) {

            //  AMBIL DURASI DARI PAKET
            $durasi = (int) ($pendaftaran->paket->durasi ?? 3);

            //  HITUNG EXPIRED SESUAI PAKET
            $expiredAt = Carbon::parse($pendaftaran->tanggal_daftar)
                ->addMonths($durasi);

            switch ($pendaftaran->status) {

                case 'pending':
                    return redirect()->route('siswa.riwayat')
                        ->with('info', 'Kamu sudah mengirim pendaftaran sebelumnya. Tunggu proses selanjutnya.');

                case 'approved':
                    if (Carbon::now()->lt($expiredAt)) {
                        return redirect()->route('siswa.riwayat')
                            ->with(
                                'info',
                                "Kamu pernah diterima sebelumnya. Langganan aktif sampai {$expiredAt->format('d M Y')}."
                            );
                    }
                    // ✅ expired → BOLEH daftar lagi
                    break;

                case 'rejected':
                    if (Carbon::now()->lt($expiredAt)) {
                        return redirect()->route('siswa.riwayat')
                            ->with(
                                'info',
                                "Kamu sudah pernah mendaftar sebelumnya. Daftar lagi setelah {$expiredAt->format('d M Y')}."
                            );
                    }
                    // ✅ lewat durasi → BOLEH daftar lagi
                    break;
            }
        }
        $paketDipilih = null;
        $jenisDipilih = null;

        if ($request->filled('paket')) {
            $selected = Pricelist::find($request->paket);

            if ($selected) {
                $paketDipilih = $selected->nama_paket;
                $jenisDipilih = $selected->jenis;
            }
        }


        // Jika belum pernah daftar atau sudah boleh daftar lagi
        return view('siswa.pendaftaran.create', compact('pendaftaran', 'pakets', 'paketDipilih', 'jenisDipilih'));
    }



    // Simpan pendaftaran siswa
    public function store(Request $request)
    {
        // ⛔ CEK STATUS GLOBAL
        if (Setting::get('pendaftaran_status') !== 'aktif') {
            return redirect()->route('home')
                ->with('error', 'Pendaftaran belum dibuka.');
        }

        $request->validate([
            'paket_id' => 'required|exists:pricelists,id',
        ]);

        $pendaftaranTerakhir = Pendaftaran::where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($pendaftaranTerakhir) {

            $durasi = (int) ($pendaftaranTerakhir->paket->durasi ?? 3);
            $expiredAt = Carbon::parse($pendaftaranTerakhir->tanggal_daftar)
                ->addMonths($durasi);

            if (
                $pendaftaranTerakhir->status === 'pending' ||
                (
                    $pendaftaranTerakhir->status === 'approved' &&
                    now()->lt($expiredAt)
                ) ||
                (
                    $pendaftaranTerakhir->status === 'rejected' &&
                    now()->lt($expiredAt)
                )
            ) {
                return back()->with(
                    'error',
                    "Kamu belum bisa mendaftar lagi. Berlaku sampai {$expiredAt->format('d M Y')}."
                );
            }
        }

        // ✅ SIMPAN PENDAFTARAN BARU
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'paket_id' => $request->paket_id,
            'pendidikan' => $request->pendidikan,
            'sekolah_univ' => $request->sekolah_univ,
            'jurusan_program' => $request->jurusan_program,
            'kelas_tingkat' => $request->kelas_tingkat,
            'nim_nisn' => $request->nim_nisn,
            'phone' => $request->phone,
            'cv_link' => $request->cv_link,
            'tanggal_daftar' => now(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('siswa.riwayat')
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }


    // Siswa lihat status pendaftaran
    public function myPendaftaran()
    {
        $data = Pendaftaran::where('user_id', Auth::id())->first();
        return view('siswa.status', compact('data'));
    }

    // Admin terima pendaftaran
    public function approve($id)
    {
        Pendaftaran::findOrFail($id)->update([
            'status' => 'approved',
            'keterangan' => null
        ]);

        return back()->with('success', 'Pendaftaran berhasil diterima');
    }

    // Admin tolak pendaftaran
    public function reject(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required'
        ]);

        Pendaftaran::findOrFail($id)->update([
            'status' => 'rejected',
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Pendaftaran berhasil ditolak');
    }

    // DASHBOARD ADMIN
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function status()
    {
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())->first();

        return view('siswa.status', compact('pendaftaran'));
    }

    public function riwayat()
    {
        $riwayat = Pendaftaran::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc') // bisa pakai tanggal_daftar juga
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
    }


    public function riwayatSiswa()
    {
        // Ambil SEMUA pendaftaran milik siswa (termasuk pending)
        $riwayat = Pendaftaran::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
    }



    public function edit()
    {
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())->firstOrFail();

        // ⛔ CEGAH EDIT JIKA BUKAN PENDING
        if ($pendaftaran->status !== 'pending') {
            return redirect()->route('/')
                ->with('error', 'Data tidak dapat diedit.');
        }
        // ✅ JIKA DATANG DARI PRICELIST
        if ($request->filled('paket')) {
            $pendaftaran->pricelist_id = $request->paket;
            $pendaftaran->save();
        }

        return view('siswa.pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request)
    {
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->firstOrFail();

        // ⛔ CEGAH UPDATE JIKA BUKAN PENDING
        if ($pendaftaran->status !== 'pending') {
            return redirect()->route('home')
                ->with('error', 'Data tidak dapat diubah.');
        }

        $validated = $request->validate([
            'pendidikan'        => 'required',
            'sekolah_univ'      => 'required',
            'jurusan_program'   => 'required',
            'kelas_tingkat'     => 'required',
            'nim_nisn'          => 'required',
            'phone'             => 'required',
            'cv_link'           => 'nullable|url',
            'jenis'             => 'required|in:reguler,privat', // 👈 TAMBAHAN
        ]);

        $pendaftaran->update($validated);

        return redirect()->route('home')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }


    public function detail($id)
    {
        // Ambil pendaftaran milik user yang sedang login
        $pendaftaran = \App\Models\Pendaftaran::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail(); // Kalau gak ketemu, otomatis 404

        return view('siswa.pendaftaran.detail', compact('pendaftaran'));
    }
}
