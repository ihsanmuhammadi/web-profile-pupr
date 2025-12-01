<div id="wrapper" class="d-flex">
    <nav id="sidebar" class="sidebar-blue">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo" height="55" class="me-3 logo-navbar">
            <h2 class="sidebar-title">Dinas PUPR</h2>
            <button class="btn btn-link toggle-sidebar-btn" style="color: #497aa9" id="sidebarToggle" aria-label="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="sidebar-menu-container">
            <p class="sidebar-menu-title">Menu</p>
            <ul class="list-unstyled components">
                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                <li class="{{ str_starts_with($currentRoute, 'admin.berita') ? 'active' : '' }}">
                    <a href="{{ route('admin.berita') }}" class="sidebar-link">
                        <span class="sidebar-icon material-symbols-outlined me-2">docs</span>
                        <span class="sidebar-text">Banner Berita</span>

                    </a>
                </li>
                <li class="{{ str_starts_with($currentRoute, 'admin.pedoman') ? 'active' : '' }}">
                    <a href="{{ route('admin.pedoman') }}" class="sidebar-link">
                        <span class="sidebar-icon material-symbols-outlined me-2">contract</span>
                        <span class="sidebar-text">Pedoman</span>
                    </a>
                </li>
                <li class="{{ str_starts_with($currentRoute, 'admin.kategori') ? 'active' : '' }}">
                    <a href="{{ route('admin.kategori') }}" class="sidebar-link">
                        <span class="sidebar-icon material-symbols-outlined me-2">category</span>
                        <span class="sidebar-text">Kategori Program</span>
                    </a>
                </li>
                <li class="{{ str_starts_with($currentRoute, 'admin.dataprogram') ? 'active' : '' }}">
                    <a href="{{ route('admin.dataprogram') }}" class="sidebar-link">
                        <span class="sidebar-icon material-symbols-outlined me-2">database</span>
                        <span class="sidebar-text">Data & Program</span>
                    </a>
                </li>
                <li class="{{ str_starts_with($currentRoute, 'admin.peluang.kerja') ? 'active' : '' }}">
                    <a href="{{ route('admin.peluang.kerja') }}" class="sidebar-link">
                        <span class="sidebar-icon material-symbols-outlined me-2">work</span>
                        <span class="sidebar-text">Peluang Kerja & Magang</span>
                    </a>
                </li>
                <li class="{{ str_starts_with($currentRoute, 'admin.lamaran') ? 'active' : '' }}">
                    <a href="{{ route('admin.lamaran') }}" class="sidebar-link">
                        <span class="sidebar-icon material-symbols-outlined me-2">assignment_ind</span>
                        <span class="sidebar-text">Lamaran</span>
                    </a>
                </li>
                <li class="{{ str_starts_with($currentRoute, 'admin.aduan') ? 'active' : '' }}">
                    <a href="{{ route('admin.aduan') }}" class="sidebar-link">
                        <span class="sidebar-icon material-symbols-outlined me-2">report</span>
                        <span class="sidebar-text">Aduan Masyarakat</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer" id="sidebarFooter">
            <div class="user-profile">
                <i class="fas fa-user-circle user-icon"></i>
                <div class="user-info">
                    <p class="user-name">{{ Auth::user()->name }}</p>
                    <p class="user-email">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <i class="fas fa-chevron-right user-arrow"></i>
        </div>
        <div class="logout-dropdown" id="logoutDropdown">
            <button class="dropdown-item " id="logoutBtn">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </div>
    </nav>

{{-- Modal Confirm Logout --}}
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-body text-center my-3">
                <p class="mb-0 fs-6">Apakah Anda yakin ingin logout?</p>
            </div>

            <div class="modal-footer border-0 justify-content-center gap-2 mb-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4">
                        Logout
                    </button>
                </form>

                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    Batal
                </button>
            </div>

        </div>
    </div>
</div>


</div>
