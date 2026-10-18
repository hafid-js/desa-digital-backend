<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\ArtikelLampiran;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('pages.admin.artikel.index');
    }

    public function tambah()
    {
        return view('pages.admin.artikel.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_artikel' => ['required', 'string', 'min:5', 'max:200'],
            'isi_artikel' => ['required', 'string'],
            'lampiran' => ['nullable', 'array', 'max:20'],
            'lampiran.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $artikel = Artikel::create([
            'judul_artikel' => $validated['judul_artikel'],
            'isi_artikel' => $validated['isi_artikel'],
        ]);

        foreach ($request->file('lampiran', []) as $index => $foto) {
            $path = $foto->store('artikel/lampiran', 'public');

            ArtikelLampiran::create([
                'artikel_id' => $artikel->id,
                'path' => $path,
                'nama_asli' => $foto->getClientOriginalName(),
                'urutan' => $index,
            ]);
        }

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil disimpan.');
    }
}
