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

    @yield('styles_page')
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

            @if(session('userdata')['idrole'] == 3)
                @include('layout.menu_mahasiswa')
            @else
                @include('layout.menu_admin')
            @endif

            {{-- <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-user-avatar">AD</div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">Admin User</div>
                        <div class="sidebar-user-role">Super Admin</div>
                    </div>
                </div>
            </div> --}}
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
                        @yield('breadcrumb')
                    </div>
                </div>

                <div class="header-right">
                    {{-- <div class="header-search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="search" placeholder="Cari sesuatu...">
                    </div> --}}

                    {{-- <button class="header-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="header-btn-badge"></span>
                    </button> --}}

                    <div class="header-user">
                        <div class="header-user-avatar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M240 192C240 147.8 275.8 112 320 112C364.2 112 400 147.8 400 192C400 236.2 364.2 272 320 272C275.8 272 240 236.2 240 192zM448 192C448 121.3 390.7 64 320 64C249.3 64 192 121.3 192 192C192 262.7 249.3 320 320 320C390.7 320 448 262.7 448 192zM144 544C144 473.3 201.3 416 272 416L368 416C438.7 416 496 473.3 496 544L496 552C496 565.3 506.7 576 520 576C533.3 576 544 565.3 544 552L544 544C544 446.8 465.2 368 368 368L272 368C174.8 368 96 446.8 96 544L96 552C96 565.3 106.7 576 120 576C133.3 576 144 565.3 144 552L144 544z"/></svg></div>
                        <span class="header-user-name">Admin</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-content">
                {{-- Alert Success --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; border-radius: 5px; margin-bottom: 20px; padding: 15px;">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none; font-size: 20px; cursor: pointer;">×</button>
                    </div>
                @endif

                {{-- Alert Error --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; border-radius: 5px; margin-bottom: 20px; padding: 15px;">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none; font-size: 20px; cursor: pointer;">×</button>
                    </div>
                @endif
                
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('scripts')
</body>
</html>
