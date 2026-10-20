@props([
    'action',
    'search' => null,
    'placeholder' => 'Cari...',
    'label' => 'Cari',
    'bersihkanUrl' => null,
    'bersihkan' => false,
])

<form action="{{ $action }}" method="GET" class="row g-2 align-items-end">
    <div class="col-12 col-md-4">
        <label class="form-label" for="cari-{{ $label }}">{{ $label }}</label>
        <div class="input-icon">
            <input type="text" name="search" id="cari-{{ $label }}" value="{{ $search }}"
                placeholder="{{ $placeholder }}" class="form-control form-control-sm">
            <span class="input-icon-addon">
                <i class="ti ti-search"></i>
            </span>
        </div>
    </div>

    {{ $slot }}

    <div class="col-12 col-md-auto">
        <div class="btn-list">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="ti ti-filter icon-lg me-1"></i>
                Terapkan
            </button>
            @if ($bersihkanUrl && $bersihkan)
                <a href="{{ $bersihkanUrl }}" class="btn btn-sm">
                    Bersihkan
                </a>
            @endif
        </div>
    </div>
</form>
