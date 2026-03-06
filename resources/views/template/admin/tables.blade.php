@extends('template.layouts.admin')

@section('title', 'Table Components')

@section('breadcrumb')
<span class="breadcrumb-current">Table Components</span>
@endsection

@section('styles')
<style>
    /* Table Styles */
    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f8fafc;
    }

    th {
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #334155;
    }

    tbody tr {
        transition: background 0.15s ease;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    /* Table Variants */
    .table-striped tbody tr:nth-child(even) {
        background: #f8fafc;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #e2e8f0;
    }

    /* Checkbox in Table */
    .table-checkbox {
        width: 18px;
        height: 18px;
        accent-color: #8b5cf6;
        cursor: pointer;
    }

    /* Avatar */
    .avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        color: white;
    }

    .avatar-purple { background: linear-gradient(135deg, #8b5cf6, #6366f1); }
    .avatar-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .avatar-green { background: linear-gradient(135deg, #10b981, #059669); }
    .avatar-orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .avatar-pink { background: linear-gradient(135deg, #ec4899, #db2777); }

    .avatar-img {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        object-fit: cover;
    }

    /* User Cell */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        color: #1e293b;
    }

    .user-email {
        font-size: 13px;
        color: #64748b;
    }

    /* Badge */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-warning {
        background: #fef3c7;
        color: #b45309;
    }

    .badge-danger {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-info {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .badge-purple {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    /* Action Buttons */
    .action-btns {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 8px;
        background: #f1f5f9;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .action-btn svg {
        width: 16px;
        height: 16px;
    }

    .action-btn-edit:hover { background: #dbeafe; color: #2563eb; }
    .action-btn-delete:hover { background: #fee2e2; color: #dc2626; }
    .action-btn-view:hover { background: #dcfce7; color: #15803d; }

    /* Progress Bar in Table */
    .progress-bar-container {
        width: 100px;
        height: 6px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 0.3s ease;
    }

    .progress-bar-fill.purple { background: linear-gradient(90deg, #8b5cf6, #6366f1); }
    .progress-bar-fill.green { background: linear-gradient(90deg, #10b981, #059669); }
    .progress-bar-fill.blue { background: linear-gradient(90deg, #3b82f6, #2563eb); }
    .progress-bar-fill.orange { background: linear-gradient(90deg, #f59e0b, #d97706); }

    /* Table Toolbar */
    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .table-toolbar-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-toolbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 260px;
        padding: 10px 14px 10px 40px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: all 0.2s;
    }

    .search-box input:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .search-box svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #94a3b8;
    }

    .filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        background: white;
        font-size: 14px;
        font-weight: 500;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-btn:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }

    .filter-btn svg {
        width: 18px;
        height: 18px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
        color: white;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }

    .btn svg {
        width: 18px;
        height: 18px;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        flex-wrap: wrap;
        gap: 16px;
    }

    .pagination-info {
        font-size: 14px;
        color: #64748b;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .pagination-btn {
        min-width: 36px;
        height: 36px;
        padding: 0 12px;
        border: none;
        border-radius: 8px;
        background: #f1f5f9;
        color: #475569;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .pagination-btn:hover {
        background: #e2e8f0;
    }

    .pagination-btn.active {
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
        color: white;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-btn svg {
        width: 16px;
        height: 16px;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .stat-icon.purple { background: #f3e8ff; }
    .stat-icon.blue { background: #dbeafe; }
    .stat-icon.green { background: #dcfce7; }
    .stat-icon.orange { background: #ffedd5; }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
    }

    .stat-label {
        font-size: 13px;
        color: #64748b;
        margin-top: 2px;
    }

    .stat-change {
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .stat-change.up { color: #10b981; }
    .stat-change.down { color: #ef4444; }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 16px;
    }

    .empty-state-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .empty-state-text {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 20px;
    }

    /* Dropdown in Table */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        min-width: 160px;
        padding: 8px;
        z-index: 100;
        display: none;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        font-size: 14px;
        color: #475569;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.15s;
    }

    .dropdown-item:hover {
        background: #f1f5f9;
    }

    .dropdown-item svg {
        width: 16px;
        height: 16px;
    }

    .dropdown-item.danger {
        color: #dc2626;
    }

    .dropdown-item.danger:hover {
        background: #fee2e2;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Table Components</h1>
    <p class="page-subtitle">Template komponen tabel untuk menampilkan data</p>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple">👥</div>
        <div class="stat-content">
            <div class="stat-value">1,234</div>
            <div class="stat-label">Total Pendaftar</div>
            <div class="stat-change up">↑ 12% dari bulan lalu</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">✅</div>
        <div class="stat-content">
            <div class="stat-value">856</div>
            <div class="stat-label">Disetujui</div>
            <div class="stat-change up">↑ 8% dari bulan lalu</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">⏳</div>
        <div class="stat-content">
            <div class="stat-value">284</div>
            <div class="stat-label">Pending Review</div>
            <div class="stat-change down">↓ 3% dari bulan lalu</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">📊</div>
        <div class="stat-content">
            <div class="stat-value">69%</div>
            <div class="stat-label">Tingkat Approval</div>
            <div class="stat-change up">↑ 5% dari bulan lalu</div>
        </div>
    </div>
</div>

<!-- Main Table -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">📋 Data Pendaftar</h2>
    </div>
    <div class="card-body">
        <!-- Table Toolbar -->
        <div class="table-toolbar">
            <div class="table-toolbar-left">
                <div class="search-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="search" placeholder="Cari pendaftar...">
                </div>
                <button class="filter-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
            </div>
            <div class="table-toolbar-right">
                <button class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Export
                </button>
                <button class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Baru
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="table-checkbox" id="checkAll">
                        </th>
                        <th>Peserta</th>
                        <th>Fakultas</th>
                        <th>Bidang Minat</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Tanggal Daftar</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" class="table-checkbox"></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-purple">AR</div>
                                <div class="user-info">
                                    <span class="user-name">Ahmad Rizki</span>
                                    <span class="user-email">ahmad.rizki@student.unair.ac.id</span>
                                </div>
                            </div>
                        </td>
                        <td>Ekonomi & Bisnis</td>
                        <td><span class="badge badge-purple">💻 Teknologi</span></td>
                        <td><span class="badge badge-success"><span class="badge-dot"></span> Disetujui</span></td>
                        <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill green" style="width: 100%;"></div>
                            </div>
                        </td>
                        <td>12 Feb 2026</td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn action-btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-delete" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="table-checkbox"></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-pink">SP</div>
                                <div class="user-info">
                                    <span class="user-name">Siti Putri</span>
                                    <span class="user-email">siti.putri@student.unair.ac.id</span>
                                </div>
                            </div>
                        </td>
                        <td>Ilmu Sosial & Politik</td>
                        <td><span class="badge badge-info">🎨 Kreatif</span></td>
                        <td><span class="badge badge-warning"><span class="badge-dot"></span> Pending</span></td>
                        <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill orange" style="width: 60%;"></div>
                            </div>
                        </td>
                        <td>14 Feb 2026</td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn action-btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-delete" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="table-checkbox"></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-blue">BW</div>
                                <div class="user-info">
                                    <span class="user-name">Budi Wijaya</span>
                                    <span class="user-email">budi.wijaya@student.unair.ac.id</span>
                                </div>
                            </div>
                        </td>
                        <td>Sains & Teknologi</td>
                        <td><span class="badge badge-secondary">🍔 F&B</span></td>
                        <td><span class="badge badge-danger"><span class="badge-dot"></span> Ditolak</span></td>
                        <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill purple" style="width: 30%;"></div>
                            </div>
                        </td>
                        <td>10 Feb 2026</td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn action-btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-delete" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="table-checkbox"></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-green">DN</div>
                                <div class="user-info">
                                    <span class="user-name">Dewi Nuraini</span>
                                    <span class="user-email">dewi.nuraini@student.unair.ac.id</span>
                                </div>
                            </div>
                        </td>
                        <td>Kedokteran</td>
                        <td><span class="badge badge-success">🌱 Social</span></td>
                        <td><span class="badge badge-success"><span class="badge-dot"></span> Disetujui</span></td>
                        <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill green" style="width: 100%;"></div>
                            </div>
                        </td>
                        <td>8 Feb 2026</td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn action-btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-delete" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="table-checkbox"></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-orange">FR</div>
                                <div class="user-info">
                                    <span class="user-name">Fajar Rahman</span>
                                    <span class="user-email">fajar.rahman@student.unair.ac.id</span>
                                </div>
                            </div>
                        </td>
                        <td>Hukum</td>
                        <td><span class="badge badge-warning">👗 Fashion</span></td>
                        <td><span class="badge badge-info"><span class="badge-dot"></span> Review</span></td>
                        <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill blue" style="width: 75%;"></div>
                            </div>
                        </td>
                        <td>15 Feb 2026</td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn action-btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="action-btn action-btn-delete" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan <strong>1-5</strong> dari <strong>1,234</strong> data
            </div>
            <div class="pagination">
                <button class="pagination-btn" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">...</button>
                <button class="pagination-btn">247</button>
                <button class="pagination-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Striped Table -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">📊 Tabel Striped</h2>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Batch</th>
                        <th>Peserta</th>
                        <th>Periode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Startup Incubation</td>
                        <td>Batch 5</td>
                        <td>120 peserta</td>
                        <td>Jan - Mar 2026</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Business Bootcamp</td>
                        <td>Batch 3</td>
                        <td>85 peserta</td>
                        <td>Feb - Apr 2026</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Digital Marketing</td>
                        <td>Batch 8</td>
                        <td>200 peserta</td>
                        <td>Mar - Mei 2026</td>
                        <td><span class="badge badge-warning">Segera</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Pitching Competition</td>
                        <td>Season 2</td>
                        <td>50 tim</td>
                        <td>Apr 2026</td>
                        <td><span class="badge badge-info">Pendaftaran</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Empty State Example -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">📭 Empty State Example</h2>
    </div>
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <h3 class="empty-state-title">Belum Ada Data</h3>
            <p class="empty-state-text">Data yang kamu cari belum tersedia. Coba tambahkan data baru atau ubah filter pencarian.</p>
            <button class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Data Baru
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Check All
    document.getElementById('checkAll').addEventListener('change', function() {
        document.querySelectorAll('.table-checkbox').forEach(cb => cb.checked = this.checked);
    });
</script>
@endsection
