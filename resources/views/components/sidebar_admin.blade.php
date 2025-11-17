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

        <div class="sidebar-footer">
            <div class="user-profile">
                <i class="fas fa-user-circle user-icon"></i>
                <div class="user-info">
                    <p class="user-name">Nama</p>
                    <p class="user-email">Email</p>
                </div>
            </div>
            <i class="fas fa-chevron-right user-arrow"></i>
        </div>
    </nav>
</div>
