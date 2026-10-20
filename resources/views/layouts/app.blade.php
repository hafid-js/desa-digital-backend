<!doctype html>
<html lang="id" data-bs-navbar-position="vertical" data-bs-layout="fluid" data-bs-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>{{ $title ?? 'Admin Desa Digital' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    @stack('head')
</head>

<body>
    <div class="page">
        @include('layouts.partials.sidebar')

        @include('layouts.partials.navbar')

        <div class="page-wrapper">
            @include('layouts.partials.header')

            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif

            @include('layouts.partials.footer')
        </div>
    </div>

    @include('layouts.partials.modals')
    @include('layouts.partials.settings')

    @livewireScripts

    @stack('scripts')
</body>
</html>
