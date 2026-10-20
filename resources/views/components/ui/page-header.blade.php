@props(['pretitle' => null, 'title'])

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                @if ($pretitle)
                    <div class="page-pretitle">{{ $pretitle }}</div>
                @endif

                <h1 class="page-title">{{ $title }}</h1>
            </div>
            @if (trim($slot))
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        {{ $slot }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
