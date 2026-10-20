<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle primary navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-brand navbar-brand-autodark pe-0 pe-md-3">
            <a href="{{ route('admin.dashboard') }}" aria-label="Admin Desa Digital">
                <svg xmlns="http://www.w3.org/2000/svg" width="110" height="32" viewBox="0 0 232 68"
                    class="navbar-brand-image">
                    <path
                        d="M64.6 16.2C63 9.9 58.1 5 51.8 3.4 40 1.5 28 1.5 16.2 3.4 9.9 5 5 9.9 3.4 16.2 1.5 28 1.5 40 3.4 51.8 5 58.1 9.9 63 16.2 64.6c11.8 1.9 23.8 1.9 35.6 0C58.1 63 63 58.1 64.6 51.8c1.9-11.8 1.9-23.8 0-35.6zM33.3 36.3l-2.8 4.4-6.6 8.2a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0zM49.2 46H37.8c-2.1 0-3.8-.9-3.8-3s1.7-3 3.8-3h11.4c2.1 0 3.7.9 3.8 3s-.7 3-3.8 3z"
                        fill="#066fd1"
                        style="fill: var(--tblr-navbar-logo-color, var(--tblr-primary, #066fd1))" />
                    <path
                        d="M105.8 46.1c.4 0 .9.2 1.2.6s.6 1 .6 1.7c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4V31.6h-2.2c-.8 0-1.4-.3-1.9-.8s-.9-1.1-.9-1.9c0-.7.3-1.4.8-1.8s1.2-.7 1.9-.7h2.2v13c0 .7.2 1.2.5 1.5s.8.5 1.4.5c.3 0 .6-.1 1.1-.2.5-.2.8-.3 1.2-.3zm28-20.7c.8 0 1.5.3 2.1.8.5.5.8 1.2.8 2.1v20.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2-.8-.8-1.2-.8-2.1v-4.5c0-.8-.3-1.5-.8-2.1-.5-.6-1.2-.8-2.1-.8s-1.5.3-2 .8-.8 1.2-.8 2.1v4.5c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4V31.6h-2.2c-.8 0-1.4-.3-1.9-.8s-.9-1.1-.9-1.9c0-.7.3-1.4.8-1.8s1.2-.7 1.9-.7h2.2v13c0 .7.2 1.2.5 1.5s.8.5 1.4.5c.3 0 .6-.1 1.1-.2.5-.2.8-.3 1.2-.3zm28-20.7c.8 0 1.5.3 2.1.8.5.5.8 1.2.8 2.1v20.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2-.8-.8-1.2-.8-2.1v-4.5c0-.8-.3-1.5-.8-2.1-.5-.6-1.2-.8-2.1-.8s-1.5.3-2 .8-.8 1.2-.8 2.1v4.5c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4V31.6h-2.2c-.8 0-1.4-.3-1.9-.8s-.9-1.1-.9-1.9c0-.7.3-1.4.8-1.8s1.2-.7 1.9-.7h2.2v13c0 .7.2 1.2.5 1.5s.8.5 1.4.5c.3 0 .6-.1 1.1-.2.5-.2.8-.3 1.2-.3zm32.1-21.3c2.2 0 4.2.6 6 1.7 1.8 1.1 3.2 2.7 4.2 4.7.6 2 1 4.3 1 6.9s-.5 4.9-1.5 6.9-2.4 3.6-4.2 4.8c-1.8 1.1-3.7 1.7-5.9 1.7-1.5 0-3-.3-4.3-.9s-2.5-1.4-3.4-2.3v.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2.1-.8c-.5-.6-.8-1.3-.8-2.1V18.9c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2.1.8c.5.6.8 1.3.8 2.1v.6c.7-1.3 1.8-2.3 3.2-3 1.3-.7 2.8-1 4.3-1zm-.7 21.3c2 0 3.7-.8 5-2.3s2-2.6 2-5.8-.6-4.2-1.9-5.7-3-2.3-5.1-2.3-3.8.8-5.1 2.3-2 3.4-2 5.7c.7 1.6 2 2.7 3.4 3.5s3.5 1.2 5.9 1.2zm23.6 1.9c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2-.8-.8-1.3-.8-2.1v-3.6c0-.8-.3-1.5-.8-2.1-.5-.6-1.2-.8-2.1-.8s-1.5.3-2 .8-.8 1.3-.8 2.1v3.6c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4v-5.4c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2 .8.8 1.3.8 2.1v5.4c0 .8.3 1.4.8 1.9s1.2.7 1.9.7h11.4c.8 0 1.4-.3 1.9-.8s.7-1.1.7-1.9v-5.4c0-.8.3-1.4.8-1.9s1.2-.7 1.9-.7zM85.5 11.9c.9 0 1.7-.3 2.4-.8s1.4-1.3 1.9-2.3.7-2.3.7-3.7v-11.4c0-.8-.3-1.5-.8-2.1-.5-.6-1.2-.8-2.1-.8s-1.5.3-2.1.8c-.5.6-.8 1.3-.8 2.1v11.4c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4V4.8c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2 .8.8 1.3.8 2.1v5.4c0 .8.3 1.4.8 1.9s1.2.7 1.9.7h11.4c.8 0 1.4-.3 1.9-.8s.7-1.1.7-1.9v-5.4c0-.8.3-1.4.8-1.9s1.2-.7 1.9-.7z"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        fill="#4a4a4a"
                        style="fill: var(--tblr-navbar-logo-color, #4a4a4a)" />
                </svg>
            </a>
        </div>

        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex me-3">
                <div class="nav-item">
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            aria-hidden="true" focusable="false" class="icon">
                            <path
                                d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454l0 .008" />
                        </svg>
                    </a>

                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            aria-hidden="true" focusable="false" class="icon">
                            <path
                                d="M8 12a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="nav-item dropdown d-none d-md-flex">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" aria-label="Show notifications"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true" focusable="false" class="icon">
                        <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                    </svg>
                </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h2 class="card-title">Notifikasi</h2>
                            <button type="button" class="btn-close ms-auto" data-navbar-notifications-close
                                aria-label="Close"></button>
                        </div>
                        <div class="card-body text-center text-secondary py-4">
                            Belum ada notifikasi baru.
                        </div>
                    </div>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span style="background-image: url({{ asset('assets/static/avatars/000m.jpg') }})"
                        class="avatar avatar-sm"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Admin Desa</div>
                        <div class="mt-1 small text-secondary">Petugas Desa</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ route('admin.pengaduan.index') }}">Pengaduan</a>
                    <a class="dropdown-item" href="{{ route('admin.surat.index') }}">Surat</a>
                </div>
            </div>
        </div>

    </div>
</header>
