<nav class="sidebar-nav">
    <!-- Main Menu -->
    <div class="nav-section">
        <div class="nav-section-title">Menu Utama</div>

        {{-- <div class="nav-item {{ request()->is('admin') ? 'open' : '' }}">
            <a href="{{ url('/template') }}" class="nav-link {{ request()->is('admin') && !request()->is('admin/ ') ? 'active' : '' }}">
                <span class="nav-link-icon">📊</span>
                <span class="nav-link-text">Dashboard</span>
            </a>
        </div> --}}

        <div class="nav-item @if($menu == 'master') open @endif">
            <div class="nav-link" onclick="toggleSubmenu(this)">
                <span class="nav-link-icon">📊</span>
                <span class="nav-link-text">Master</span>
                {{-- <span class="nav-link-badge">24</span> --}}
                <span class="nav-link-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </div>
            <div class="nav-submenu">
                <a href="{{ route('admin.master.bidang_bisnis') }}" class="nav-link @if($submenu == 'bidang_bisnis') active @endif">
                    <span class="nav-link-text">Bidang Bisnis</span>
                </a>
                
            </div>
        </div>

        <!-- Menu with Submenu (2 Level) -->
        <div class="nav-item @if($menu == 'pendaftaran') open @endif">
            <div class="nav-link" onclick="toggleSubmenu(this)">
                <span class="nav-link-icon">👥</span>
                <span class="nav-link-text">Pendaftaran</span>
                {{-- <span class="nav-link-badge">24</span> --}}
                <span class="nav-link-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </div>
            <div class="nav-submenu">
                <a href="{{ route('admin.index') }}" class="nav-link @if($submenu == 'semua_pendaftaran') active @endif">
                    <span class="nav-link-text">Semua Pendaftaran</span>
                </a>
                
            </div>
        </div>

        <!-- Another 2 Level Menu -->
        {{-- <div class="nav-item {{ request()->is('admin/program*') ? 'open' : '' }}">
            <div class="nav-link" onclick="toggleSubmenu(this)">
                <span class="nav-link-icon">📚</span>
                <span class="nav-link-text">Program</span>
                <span class="nav-link-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </div>
            <div class="nav-submenu">
                <a href="{{ url('/admin/program/batch') }}" class="nav-link {{ request()->is('admin/program/batch') ? 'active' : '' }}">
                    <span class="nav-link-text">Batch Program</span>
                </a>
                <a href="{{ url('/admin/program/jadwal') }}" class="nav-link {{ request()->is('admin/program/jadwal') ? 'active' : '' }}">
                    <span class="nav-link-text">Jadwal Kegiatan</span>
                </a>
                <a href="{{ url('/admin/program/materi') }}" class="nav-link {{ request()->is('admin/program/materi') ? 'active' : '' }}">
                    <span class="nav-link-text">Materi & Modul</span>
                </a>
            </div>
        </div>

        <!-- Single Level Menu -->
        <div class="nav-item">
            <a href="{{ url('/admin/mentor') }}" class="nav-link {{ request()->is('admin/mentor*') ? 'active' : '' }}">
                <span class="nav-link-icon">🎓</span>
                <span class="nav-link-text">Mentor</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ url('/admin/events') }}" class="nav-link {{ request()->is('admin/events*') ? 'active' : '' }}">
                <span class="nav-link-icon">📅</span>
                <span class="nav-link-text">Events</span>
            </a>
        </div> --}}
    </div>

    <!-- Template Section -->
    {{-- <div class="nav-section">
        <div class="nav-section-title">Templates</div>

        <div class="nav-item">
            <a href="{{ url('/template/forms') }}" class="nav-link {{ request()->is('template/forms') ? 'active' : '' }}">
                <span class="nav-link-icon">📝</span>
                <span class="nav-link-text">Form Components</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ url('/template/tables') }}" class="nav-link {{ request()->is('template/tables') ? 'active' : '' }}">
                <span class="nav-link-icon">📋</span>
                <span class="nav-link-text">Table Components</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ url('/template/blank') }}" class="nav-link {{ request()->is('template/blank') ? 'active' : '' }}">
                <span class="nav-link-icon">📄</span>
                <span class="nav-link-text">Blank Page</span>
            </a>
        </div>
    </div> --}}
    <div class="nav-section">
        <div class="nav-item {{ request()->is('admin') ? 'open' : '' }}">
            <a href="{{ route('logout') }}" class="nav-link">
                <span class="nav-link-icon">↩</span>
                <span class="nav-link-text">Logout</span>
            </a>
        </div>
    </div>

    

    
</nav>