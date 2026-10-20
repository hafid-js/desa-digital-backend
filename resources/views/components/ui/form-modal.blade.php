@props(['id', 'title'])

<div class="modal modal-blur fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-modal="true"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $title }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
