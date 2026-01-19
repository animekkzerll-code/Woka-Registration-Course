<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    public function index()
    {
        $pricelists = Pricelist::orderBy('id', 'asc')->get();
        return view('admin.pricelist.index', compact('pricelists'));
    }

    public function create(Request $request)
    {
        $paketDipilih = $request->paket;

        $pakets = Pricelist::where('is_active', true)
            ->orderBy('durasi')
            ->get()
            ->groupBy('nama_paket');

        return view('admin.pricelist.create', compact(
            'pakets',
            'paketDipilih'
        ));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis'      => 'required|in:reguler,group,privat',
            'durasi'     => 'required',
            'harga'      => 'required|numeric|min:0',
            'is_active'  => 'nullable|boolean',
        ]);

        Pricelist::create([
            'nama_paket' => $request->nama_paket,
            'jenis'      => $request->jenis,
            'durasi'     => $request->durasi,
            'harga'      => $request->harga,
            'features'   => [],
            'is_active'  => $request->is_active ?? 1,
        ]);

        return redirect()
            ->route('admin.pricelist.index')
            ->with('success', 'Paket berhasil ditambahkan');
    }

    public function publicIndex()
    {
        $reguler = Pricelist::where('jenis', 'reguler')
            ->where('is_active', 1)
            ->orderBy('harga')
            ->get();

        $privat = Pricelist::whereIn('jenis', ['privat', 'group'])
            ->where('is_active', 1)
            ->orderBy('harga')
            ->get();

        return view('pricelist', compact('reguler', 'privat'));
    }











    public function edit(Pricelist $pricelist)
    {
        return view('admin.pricelist.edit', compact('pricelist'));
    }

    public function update(Request $request, Pricelist $pricelist)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required',
            'durasi' => 'required',
            'harga' => 'required|numeric',
            'is_active' => 'required'
        ]);

        $pricelist->update($request->all());

        return redirect()
            ->route('admin.pricelist.index')
            ->with('success', 'Paket berhasil diperbarui');
    }


    public function destroy($id)
    {
        Pricelist::findOrFail($id)->delete();

        return back()->with('success', 'Paket berhasil dihapus');
    }


    public function pricelist()
    {
        $reguler = Pricelist::where('jenis', 'reguler')
            ->where('is_active', 1)
            ->orderBy('harga')
            ->get();

        $privat = Pricelist::whereIn('jenis', ['privat', 'group'])
            ->where('is_active', 1)
            ->orderBy('harga')
            ->get();

        return view('home.pricelist', compact('reguler', 'privat'));
    }
}
