@props([
    'label',
    'nilai',
    'ikon',
    'warna' => 'primary',
    'keterangan' => null,
    'link' => null,
    'variant' => 'icon-left',
])

@php
    $tag = $link ? 'a' : 'div';
    $classes = 'card card-sm'.($link ? ' text-decoration-none' : '');
@endphp

<{{ $tag }} @if ($link) href="{{ $link }}" @endif {{ $attributes->merge(['class' => $classes]) }}>
    <div class="card-body">
        @if ($variant === 'icon-right')
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="h1 mb-0">{{ $nilai }}</div>
                    <div class="text-secondary">{{ $label }}</div>
                </div>
                <span class="bg-{{ $warna }} text-{{ $warna }}-fg avatar">
                    <i class="ti {{ $ikon }} icon-lg"></i>
                </span>
            </div>
        @else
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="bg-{{ $warna }} text-{{ $warna }}-fg avatar">
                        <i class="ti {{ $ikon }} icon-lg"></i>
                    </span>
                </div>
                <div class="col">
                    <div class="font-weight-medium">{{ $nilai }}</div>
                    <div class="text-secondary">{{ $label }}</div>
                </div>
            </div>
        @endif

        @if ($keterangan)
            <div class="text-secondary small mt-2">{{ $keterangan }}</div>
        @endif
    </div>
</{{ $tag }}>
