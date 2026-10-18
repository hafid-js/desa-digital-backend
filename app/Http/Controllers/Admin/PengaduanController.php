<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\PengaduanTanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    /**
     * Daftar semua pengaduan (kelola admin).
     * Admin hanya bisa lihat & tanggapi, tidak bisa menambah data baru.
     * Data pengaduan datang dari aplikasi Flutter warga.
     */
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_laporan', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('wilayah', 'like', "%{$search}%")
                    ->orWhere('rincian', 'like', "%{$search}%");
            });
        }

        $pengaduans = $query->orderByDesc('created_at')->paginate(10);

        return view('pages.admin.pengaduan.index', [
            'pengaduans' => $pengaduans,
            'statuses' => Pengaduan::STATUSES,
            'selectedStatus' => $request->status,
            'search' => $request->search,
        ]);
    }

    /**
     * Detail pengaduan beserta riwayat tanggapan.
     */
    public function detail(string $kode)
    {
        $pengaduan = Pengaduan::where('kode_laporan', $kode)->firstOrFail();

        return view('pages.admin.pengaduan.detail', [
            'pengaduan' => $pengaduan,
            'tanggapans' => $pengaduan->tanggapans,
            'statuses' => Pengaduan::STATUSES,
        ]);
    }

    /**
     * Beri tanggapan dan/atau ubah status pengaduan (admin/petugas desa).
     * Tidak ada endpoint tambah pengaduan dari sisi admin.
     */
    public function tanggapan(Request $request, string $kode)
    {
        $pengaduan = Pengaduan::where('kode_laporan', $kode)->firstOrFail();

        $validated = Validator::make($request->all(), [
            'tanggapan' => ['required', 'string', 'min:5'],
            'status' => ['sometimes', 'string', 'in:'.implode(',', Pengaduan::STATUSES)],
        ])->validate();

        $statusSebelum = $pengaduan->status;

        $pengaduan->tanggapan = $validated['tanggapan'];
        if (isset($validated['status'])) {
            $pengaduan->status = $validated['status'];
        }
        $pengaduan->save();

        PengaduanTanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'tanggapan' => $validated['tanggapan'],
            'status_sebelum' => $statusSebelum,
            'status_sesudah' => $pengaduan->status,
            'diberi_oleh' => auth()->user() ? auth()->user()->name : 'Admin',
        ]);

        return back()
            ->with('success', 'Tanggapan berhasil disimpan.');
    }
}
