<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - AYE Program</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
        }

        /* Layout */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1e1b4b 0%, #312e81 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }

        .sidebar-logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .sidebar-logo-text {
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar-logo-subtitle {
            font-size: 11px;
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Navigation */
        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 8px;
        }

        .nav-section-title {
            padding: 12px 24px 8px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 600;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .nav-link.active {
            background: rgba(139, 92, 246, 0.3);
            color: white;
            border-right: 3px solid #a78bfa;
        }

        .nav-link-icon {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .nav-link-text {
            flex: 1;
        }

        .nav-link-arrow {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .nav-link-arrow svg {
            width: 16px;
            height: 16px;
        }

        .nav-item.open > .nav-link .nav-link-arrow {
            transform: rotate(90deg);
        }

        .nav-link-badge {
            background: #ef4444;
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 10px;
        }

        /* Submenu */
        .nav-submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(0, 0, 0, 0.15);
        }

        .nav-item.open > .nav-submenu {
            max-height: 500px;
        }

        .nav-submenu .nav-link {
            padding-left: 60px;
            font-size: 13px;
            position: relative;
        }

        .nav-submenu .nav-link::before {
            content: '';
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            position: absolute;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            transition: background 0.2s;
        }

        .nav-submenu .nav-link:hover::before,
        .nav-submenu .nav-link.active::before {
            background: #a78bfa;
        }

        .nav-submenu .nav-link.active {
            background: rgba(139, 92, 246, 0.2);
            border-right: none;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .sidebar-user-info {
            flex: 1;
        }

        .sidebar-user-name {
            font-size: 14px;
            font-weight: 600;
        }

        .sidebar-user-role {
            font-size: 12px;
            opacity: 0.6;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .top-header {
            background: white;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: none;
            background: #f1f5f9;
            border-radius: 10px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle svg {
            width: 24px;
            height: 24px;
            color: #64748b;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #64748b;
        }

        .breadcrumb a {
            color: #64748b;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: #8b5cf6;
        }

        .breadcrumb-separator {
            color: #cbd5e1;
        }

        .breadcrumb-current {
            color: #1e293b;
            font-weight: 500;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-search {
            position: relative;
        }

        .header-search input {
            width: 280px;
            padding: 10px 16px 10px 42px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: all 0.2s;
        }

        .header-search input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .header-search svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #94a3b8;
        }

        .header-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: #f1f5f9;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.2s;
        }

        .header-btn:hover {
            background: #e2e8f0;
        }

        .header-btn svg {
            width: 20px;
            height: 20px;
            color: #64748b;
        }

        .header-btn-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px 6px 6px;
            background: #f8fafc;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .header-user:hover {
            background: #f1f5f9;
        }

        .header-user-avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 12px;
        }

        .header-user-name {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        /* Page Content */
        .page-content {
            padding: 32px;
            flex: 1;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 15px;
            color: #64748b;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
        }

        .card-body {
            padding: 24px;
        }

        .card-footer {
            padding: 16px 24px;
            border-top: 1px solid #f1f5f9;
            background: #f8fafc;
            border-radius: 0 0 16px 16px;
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.open {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
            }

            .header-search input {
                width: 200px;
            }
        }

        @media (max-width: 640px) {
            .top-header {
                padding: 12px 16px;
            }

            .header-search {
                display: none;
            }

            .page-content {
                padding: 20px 16px;
            }

            .page-title {
                font-size: 22px;
            }
        }

        /* Utility Classes */
        .text-muted { color: #64748b; }
        .text-primary { color: #8b5cf6; }
        .text-success { color: #10b981; }
        .text-danger { color: #ef4444; }
        .text-warning { color: #f59e0b; }

        .mb-0 { margin-bottom: 0; }
        .mb-1 { margin-bottom: 8px; }
        .mb-2 { margin-bottom: 16px; }
        .mb-3 { margin-bottom: 24px; }
        .mb-4 { margin-bottom: 32px; }

        .mt-0 { margin-top: 0; }
        .mt-1 { margin-top: 8px; }
        .mt-2 { margin-top: 16px; }
        .mt-3 { margin-top: 24px; }
        .mt-4 { margin-top: 32px; }

        .d-flex { display: flex; }
        .align-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-1 { gap: 8px; }
        .gap-2 { gap: 16px; }

        
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ url('/admin') }}" class="sidebar-logo">
                    <div class="sidebar-logo-icon">🚀</div>
                    <div>
                        <div class="sidebar-logo-text">AYE Admin</div>
                        <div class="sidebar-logo-subtitle">Youth Entrepreneur</div>
                    </div>
                </a>
            </div>

            <nav class="sidebar-nav">
                <!-- Main Menu -->
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>

                    <div class="nav-item {{ request()->is('admin') ? 'open' : '' }}">
                        <a href="{{ url('/template') }}" class="nav-link {{ request()->is('admin') && !request()->is('admin/ ') ? 'active' : '' }}">
                            <span class="nav-link-icon">📊</span>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </div>

                    <!-- Menu with Submenu (2 Level) -->
                    <div class="nav-item {{ request()->is('admin/pendaftar*') ? 'open' : '' }}">
                        <div class="nav-link" onclick="toggleSubmenu(this)">
                            <span class="nav-link-icon">👥</span>
                            <span class="nav-link-text">Pendaftar</span>
                            <span class="nav-link-badge">24</span>
                            <span class="nav-link-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                        <div class="nav-submenu">
                            <a href="{{ url('/admin/pendaftar') }}" class="nav-link {{ request()->is('admin/pendaftar') ? 'active' : '' }}">
                                <span class="nav-link-text">Semua Pendaftar</span>
                            </a>
                            <a href="{{ url('/admin/pendaftar/baru') }}" class="nav-link {{ request()->is('admin/pendaftar/baru') ? 'active' : '' }}">
                                <span class="nav-link-text">Pendaftar Baru</span>
                            </a>
                            <a href="{{ url('/admin/pendaftar/disetujui') }}" class="nav-link {{ request()->is('admin/pendaftar/disetujui') ? 'active' : '' }}">
                                <span class="nav-link-text">Disetujui</span>
                            </a>
                            <a href="{{ url('/admin/pendaftar/ditolak') }}" class="nav-link {{ request()->is('admin/pendaftar/ditolak') ? 'active' : '' }}">
                                <span class="nav-link-text">Ditolak</span>
                            </a>
                        </div>
                    </div>

                    <!-- Another 2 Level Menu -->
                    <div class="nav-item {{ request()->is('admin/program*') ? 'open' : '' }}">
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
                    </div>
                </div>

                <!-- Template Section -->
                <div class="nav-section">
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
                </div>

                <!-- Settings Section -->
                <div class="nav-section">
                    <div class="nav-section-title">Pengaturan</div>

                    <div class="nav-item {{ request()->is('admin/settings*') ? 'open' : '' }}">
                        <div class="nav-link" onclick="toggleSubmenu(this)">
                            <span class="nav-link-icon">⚙️</span>
                            <span class="nav-link-text">Settings</span>
                            <span class="nav-link-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                        <div class="nav-submenu">
                            <a href="{{ url('/admin/settings/general') }}" class="nav-link {{ request()->is('admin/settings/general') ? 'active' : '' }}">
                                <span class="nav-link-text">General</span>
                            </a>
                            <a href="{{ url('/admin/settings/users') }}" class="nav-link {{ request()->is('admin/settings/users') ? 'active' : '' }}">
                                <span class="nav-link-text">Users & Roles</span>
                            </a>
                            <a href="{{ url('/admin/settings/email') }}" class="nav-link {{ request()->is('admin/settings/email') ? 'active' : '' }}">
                                <span class="nav-link-text">Email Templates</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-user-avatar">AD</div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">Admin User</div>
                        <div class="sidebar-user-role">Super Admin</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" onclick="toggleSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="breadcrumb">
                        <a href="{{ url('/admin') }}">Admin</a>
                        <span class="breadcrumb-separator">/</span>
                        @yield('breadcrumb')
                    </div>
                </div>

                <div class="header-right">
                    <div class="header-search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="search" placeholder="Cari sesuatu...">
                    </div>

                    <button class="header-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="header-btn-badge"></span>
                    </button>

                    <div class="header-user">
                        <div class="header-user-avatar">AD</div>
                        <span class="header-user-name">Admin</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        function toggleSubmenu(element) {
            const navItem = element.closest('.nav-item');
            navItem.classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('open');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
