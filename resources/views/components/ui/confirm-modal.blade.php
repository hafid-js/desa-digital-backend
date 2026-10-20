@props([
    'id',
    'judul' => 'Konfirmasi Penghapusan Data',
    'pesan' => null,
    'ketikHapus' => true,
])

<div class="modal modal-blur fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-modal="true"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ $judul }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true" focusable="false"
                    class="icon mb-2 text-danger icon-lg">
                    <path d="M12 9v4"></path>
                    <path
                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0">
                    </path>
                    <path d="M12 16h.01"></path>
                </svg>
                <div class="card-body">
                    <h1>Perhatian</h1>
                </div>
                <h3>Penghapusan data bersifat permanen dan tidak dapat dikembalikan</h3>
                <p class="text-warning mb-3">
                    {{ $pesan ?? 'Apakah anda yakin ingin menghapus data ini?' }}
                </p>
                @if ($ketikHapus)
                    <div class="d-flex flex-column align-items-start gap-2">
                        <input type="text" class="form-control" placeholder="Ketik HAPUS untuk melanjutkan">

                        <span class="d-inline-flex align-items-center gap-2">
                            <i class="ti ti-info-circle"></i>
                            <p class="mb-0">Ketik "<strong>HAPUS</strong>" (case sensitive)</p>
                        </span>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col">
                        <button type="button" data-bs-dismiss="modal" class="btn w-100 btn-sm">
                            <i class="ti ti-logout icon-lg me-1"></i> Tutup
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm w-100">
                            <i class="ti ti-trash icon-lg me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
