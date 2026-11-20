<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();

        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('buku.form', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:bukus,kode|max:10',
            'judul' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }
    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();

        return view('buku.form', compact('buku', 'kategoris'));
    }
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode' => 'required|unique:bukus,kode,' . $buku->id . '|max:10',
            'judul' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui');
    }
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}