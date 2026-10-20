

      <aside class="navbar navbar-vertical navbar-expand-lg">
          <div class="container-fluid">

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                  aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle sidebar navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="navbar-brand navbar-brand-autodark">
                  <a href="." aria-label="Tabler">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 68 68" width="32" height="32"
                          aria-label="Tabler" class="navbar-brand-image">
                          <path
                              d="M64.6 16.2C63 9.9 58.1 5 51.8 3.4 40 1.5 28 1.5 16.2 3.4 9.9 5 5 9.9 3.4 16.2 1.5 28 1.5 40 3.4 51.8 5 58.1 9.9 63 16.2 64.6c11.8 1.9 23.8 1.9 35.6 0C58.1 63 63 58.1 64.6 51.8c1.9-11.8 1.9-23.8 0-35.6zM33.3 36.3c-2.8 4.4-6.6 8.2-11.1 11-1.5.9-3.3.9-4.8.1s-2.4-2.3-2.5-4c0-1.7.9-3.3 2.4-4.1 2.3-1.4 4.4-3.2 6.1-5.3-1.8-2.1-3.8-3.8-6.1-5.3-2.3-1.3-3-4.2-1.7-6.4s4.3-2.9 6.5-1.6c4.5 2.8 8.2 6.5 11.1 10.9 1 1.4 1 3.3.1 4.7zM49.2 46H37.8c-2.1 0-3.8-1-3.8-3s1.7-3 3.8-3h11.4c2.1 0 3.8 1 3.8 3s-1.7 3-3.8 3z"
                              fill="#066fd1"
                              style="fill: var(--tblr-navbar-logo-color, var(--tblr-primary, #066fd1))" />
                      </svg>
                  </a>
              </div>

              <div class="navbar-footer">
                  <ul class="navbar-nav">
                      <li class="nav-item dropup">
                          <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-label="Open user menu">
                              <span style="background-image: url({{ asset('assets/static/avatars/000m.jpg') }})"
                                  class="avatar avatar-sm"></span>
                              <div class="nav-link-title">
                                  Paweł Kuna
                                  <div class="small text-secondary">UI Designer</div>
                              </div>
                          </a>
                          <div class="dropdown-menu">
                              <a class="dropdown-item"
                                  href="./profile.html">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
                                      focusable="false" class="icon dropdown-item-icon">
                                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                  </svg>
                                  Profile</a>
                              <a class="dropdown-item"
                                  href="#">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
                                      focusable="false" class="icon dropdown-item-icon">
                                      <path
                                          d="M10 3.2a9 9 0 1 0 10.8 10.8a1 1 0 0 0 -1 -1h-6.8a2 2 0 0 1 -2 -2v-7a.9 .9 0 0 0 -1 -.8" />
                                      <path d="M15 3.5a9 9 0 0 1 5.5 5.5h-4.5a1 1 0 0 1 -1 -1v-4.5" />
                                  </svg>
                                  Analytics</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="./settings.html">Settings &amp; Privacy</a>
                              <a class="dropdown-item" href="#">Help</a>
                              <a class="dropdown-item" href="./sign-in.html">Sign out</a>
                          </div>
                      </li>
                  </ul>
              </div>

              <nav class="collapse navbar-collapse" id="sidebar-menu" aria-label="Sidebar">

                  <ul class="navbar-nav pt-lg-3">

                      <li class="nav-section-title">Main Menu</li>
                      <li class="nav-item">
                          <a href="{{ route('admin.dashboard') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-dashboard icon-lg"></i></span>
                              <span class="nav-link-title">Dashboard</span>
                          </a>
                          <a href="{{ route('admin.artikel.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-photo-video icon-lg"></i></span>
                              <span class="nav-link-title">Artikel</span>
                          </a>
                           <a href="{{ route('admin.kategori.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-list icon-lg"></i></span>
                              <span class="nav-link-title">Kategori</span>
                          </a>
                          <a href="{{ route('admin.agenda.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-calendar-week icon-lg"></i></span>
                              <span class="nav-link-title">Agenda</span>
                          </a>
                          <a href="{{ route('admin.apbdes.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-coins icon-lg"></i></span>
                              <span class="nav-link-title">APBDes</span>
                          </a>
                          <a href="{{ route('admin.banner.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                 <i class="ti ti-carousel-horizontal icon-lg"></i></span>
                              <span class="nav-link-title">Banner</span>
                          </a>
                          <a href="{{ route('admin.pengaduan.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-alert-circle icon-lg"></i></span>
                              <span class="nav-link-title">Pengaduan</span>
                          </a>
                          <a href="{{ route('admin.surat.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-file-certificate icon-lg"></i></span>
                              <span class="nav-link-title">Surat</span>
                          </a>
                          <a href="{{ route('admin.cuaca.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-thermometer icon-lg"></i></span>
                              <span class="nav-link-title">Cuaca</span>
                          </a>
                          <a href="{{ route('admin.lapak.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-shopping-bag icon-lg"></i></span>
                              <span class="nav-link-title">Lapak Warga</span>
                          </a>
                      </li>

                      <li class="nav-section-title">System</li>
                      <!-- BEGIN NAVBAR ITEM -->
                      <li class="nav-item">
                          <a href="{{ route('admin.roles.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-shield-check icon-lg"></i></span>
                              <span class="nav-link-title">Role</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.users.index') }}" type="button" class="nav-link">
                              <span class="nav-link-icon">
                                  <i class="ti ti-users icon-lg"></i></span>
                              <span class="nav-link-title">Pengguna</span>
                          </a>
                      </li>

                  </ul>

              </nav>
          </div>
      </aside>

