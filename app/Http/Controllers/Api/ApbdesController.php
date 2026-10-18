<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApbdesController extends Controller
{
    public function index(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'tahun' => ['sometimes', 'integer', 'min:2000', 'max:2100'],
        ])->validate();

        $tahun = $validated['tahun'] ?? now()->year;

        $sections = [
            Apbdes::SECTION_PELAKSANAAN => 'APBDes '.$tahun.' Pelaksanaan',
            Apbdes::SECTION_PENDAPATAN => 'APBDes '.$tahun.' Pendapatan',
            Apbdes::SECTION_PEMBELANJAAN => 'APBDes '.$tahun.' Pembelanjaan',
        ];

        $data = [];

        foreach (Apbdes::SECTIONS as $section) {
            $items = Apbdes::where('section', $section)
                ->where('tahun_anggaran', $tahun)
                ->orderBy('judul')
                ->get()
                ->map(fn ($item) => [
                    'judul' => $item->judul,
                    'jumlah_realisasi' => $item->jumlah_realisasi,
                    'jumlah_target' => $item->jumlah_target,
                    'persentase' => $item->persentase,
                    'percentage_text' => $item->persentase.'%',
                ]);

            $data[$section] = [
                'title' => $sections[$section],
                'items' => $items->values()->all(),
            ];
        }

        return response()->json([
            'data' => $data,
            'meta' => [
                'tahun_anggaran' => $tahun,
                'sections' => Apbdes::SECTIONS,
                'total_items' => collect($data)->sum(fn ($s) => count($s['items'])),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'in:'.implode(',', Apbdes::SECTIONS)],
            'jumlah_realisasi' => ['sometimes', 'integer', 'min:0'],
            'jumlah_target' => ['sometimes', 'integer', 'min:0'],
            'persentase' => ['sometimes', 'numeric', 'between:0,100'],
            'tahun_anggaran' => ['required', 'integer', 'min:2000', 'max:2100'],
        ])->validate();

        if (! isset($validated['persentase'])) {
            $target = $validated['jumlah_target'] ?? 0;
            $real = $validated['jumlah_realisasi'] ?? 0;
            $validated['persentase'] = $target > 0 ? round(($real / $target) * 100, 2) : 0;
        }

        $apbdes = Apbdes::create($validated);

        return response()->json([
            'data' => $apbdes,
            'meta' => [
                'message' => 'Data APBDes berhasil disimpan.',
            ],
        ], 201);
    }

    public function update(Request $request, Apbdes $apbdes)
    {
        $validated = Validator::make($request->all(), [
            'judul' => ['sometimes', 'string', 'max:255'],
            'section' => ['sometimes', 'string', 'in:'.implode(',', Apbdes::SECTIONS)],
            'jumlah_realisasi' => ['sometimes', 'integer', 'min:0'],
            'jumlah_target' => ['sometimes', 'integer', 'min:0'],
            'persentase' => ['sometimes', 'numeric', 'between:0,100'],
            'tahun_anggaran' => ['sometimes', 'integer', 'min:2000', 'max:2100'],
        ])->validate();

        if (isset($validated['jumlah_realisasi']) || isset($validated['jumlah_target'])) {
            $target = $validated['jumlah_target'] ?? $apbdes->jumlah_target;
            $real = $validated['jumlah_realisasi'] ?? $apbdes->jumlah_realisasi;
            if (! isset($validated['persentase'])) {
                $validated['persentase'] = $target > 0 ? round(($real / $target) * 100, 2) : 0;
            }
        }

        $apbdes->update($validated);

        return response()->json([
            'data' => $apbdes->fresh(),
            'meta' => [
                'message' => 'Data APBDes berhasil diperbarui.',
            ],
        ]);
    }
}
