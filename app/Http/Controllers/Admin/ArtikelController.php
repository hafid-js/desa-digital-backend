<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\ArtikelLampiran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.artikel.index');
    }

    public function tambah(): View
    {
        return view('pages.admin.artikel.tambah');
    }

    public function store(Request $request): RedirectResponse
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
