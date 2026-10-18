<!doctype html>
<html lang="id" data-bs-navbar-position="vertical" data-bs-layout="fluid" data-bs-theme="dark">
<head>
    <!-- BEGIN META -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- END META -->

    <title>{{ $title ?? 'Admin Desa Digital' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    @stack('head')

</head>

<body>
    <!-- END GLOBAL THEME SCRIPT -->

    <div class="page">
        <!-- BEGIN SIDEBAR -->
        @include('layouts.partials.sidebar')
        <!-- END SIDEBAR -->

        <!-- BEGIN NAVBAR -->
        @include('layouts.partials.navbar')
        <!-- END NAVBAR -->

        <div class="page-wrapper">
            <!-- BEGIN PAGE HEADER -->
            @include('layouts.partials.header')
            <!-- END PAGE HEADER -->

            <!-- BEGIN PAGE BODY -->
            @yield('content')
            <!-- END PAGE BODY -->

            <!-- BEGIN FOOTER -->
            @include('layouts.partials.footer')
            <!-- END FOOTER -->
        </div>
    </div>

    @include('layouts.partials.modals')
    @include('layouts.partials.settings')

    @livewireScripts

    @stack('scripts')
</body>
</html>
