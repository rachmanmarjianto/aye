@extends('template.layouts.admin')

@section('title', 'Form Components')

@section('breadcrumb')
<span class="breadcrumb-current">Form Components</span>
@endsection

@section('styles')
<style>
    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-row-3 {
        grid-template-columns: repeat(3, 1fr);
    }

    @media (max-width: 768px) {
        .form-row, .form-row-3 {
            grid-template-columns: 1fr;
        }
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .label-hint {
        font-weight: 400;
        color: #9ca3af;
        font-size: 12px;
        margin-left: 6px;
    }

    /* Input Wrapper with Icon */
    .input-wrapper {
        position: relative;
    }

    .input-wrapper svg,
    .input-wrapper .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #9ca3af;
        pointer-events: none;
    }

    .input-wrapper .input-icon {
        font-size: 16px;
        width: auto;
        height: auto;
    }

    .input-wrapper input,
    .input-wrapper select {
        padding-left: 44px;
    }

    /* Base Input Styles */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    input[type="tel"],
    input[type="url"],
    input[type="date"],
    input[type="time"],
    input[type="datetime-local"],
    input[type="month"],
    input[type="week"],
    input[type="search"],
    input[type="color"],
    select,
    textarea {
        width: 100%;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: all 0.2s ease;
        background: #f9fafb;
        color: #1f2937;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #8b5cf6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    input::placeholder,
    textarea::placeholder {
        color: #9ca3af;
    }

    /* Textarea */
    textarea {
        min-height: 100px;
        resize: vertical;
        line-height: 1.5;
    }

    /* Select */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 18px;
        padding-right: 44px;
        cursor: pointer;
    }

    select[multiple] {
        background-image: none;
        padding: 10px;
        min-height: 120px;
    }

    select[multiple] option {
        padding: 8px 10px;
        border-radius: 6px;
        margin-bottom: 4px;
    }

    /* Radio & Checkbox Group */
    .option-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .option-group.horizontal {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 16px;
    }

    .option-group.grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 10px;
    }

    /* Card Style Option */
    .radio-item,
    .checkbox-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .radio-item:hover,
    .checkbox-item:hover {
        border-color: #c4b5fd;
        background: #faf5ff;
    }

    .radio-item.selected,
    .checkbox-item.selected {
        border-color: #8b5cf6;
        background: #faf5ff;
    }

    .radio-item input[type="radio"],
    .checkbox-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-top: 2px;
        accent-color: #8b5cf6;
        cursor: pointer;
        flex-shrink: 0;
    }

    .option-content {
        flex: 1;
    }

    .option-label {
        font-weight: 600;
        color: #1f2937;
        font-size: 14px;
    }

    .option-description {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }

    /* Simple Option */
    .simple-option {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 14px;
        color: #4b5563;
    }

    .simple-option input {
        width: 18px;
        height: 18px;
        accent-color: #8b5cf6;
        cursor: pointer;
    }

    /* Range Slider */
    input[type="range"] {
        width: 100%;
        height: 6px;
        border-radius: 10px;
        background: #e5e7eb;
        appearance: none;
        outline: none;
    }

    input[type="range"]::-webkit-slider-thumb {
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.4);
    }

    .range-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        font-size: 12px;
        color: #6b7280;
    }

    .range-value {
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        color: #8b5cf6;
        margin-top: 8px;
    }

    /* File Upload */
    .file-upload {
        position: relative;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        background: #f9fafb;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .file-upload:hover {
        border-color: #8b5cf6;
        background: #faf5ff;
    }

    .file-upload input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-upload-icon {
        font-size: 40px;
        margin-bottom: 12px;
    }

    .file-upload-text {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .file-upload-hint {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 4px;
    }

    /* Color Picker */
    .color-picker-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    input[type="color"] {
        width: 50px;
        height: 50px;
        padding: 4px;
        border-radius: 10px;
        cursor: pointer;
    }

    .color-value {
        font-family: monospace;
        font-size: 14px;
        color: #4b5563;
        background: #f3f4f6;
        padding: 8px 14px;
        border-radius: 8px;
    }

    /* Rating */
    .rating-container {
        display: flex;
        gap: 6px;
    }

    .rating-star {
        font-size: 32px;
        cursor: pointer;
        transition: transform 0.2s;
        color: #d1d5db;
    }

    .rating-star:hover {
        transform: scale(1.15);
    }

    .rating-star.active {
        color: #fbbf24;
    }

    /* Scale Rating */
    .scale-rating {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .scale-item {
        width: 40px;
        height: 40px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #f9fafb;
    }

    .scale-item:hover {
        border-color: #8b5cf6;
        color: #8b5cf6;
    }

    .scale-item.selected {
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
        border-color: #8b5cf6;
        color: white;
    }

    /* Toggle Switch */
    .toggle-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .toggle {
        position: relative;
        width: 50px;
        height: 26px;
        background: #d1d5db;
        border-radius: 26px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .toggle::after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .toggle.active {
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
    }

    .toggle.active::after {
        transform: translateX(24px);
    }

    .toggle-label {
        font-size: 14px;
        color: #374151;
    }

    /* Helper Text */
    .helper-text {
        margin-top: 6px;
        font-size: 12px;
        color: #6b7280;
    }

    .error-text {
        color: #ef4444;
    }

    .success-text {
        color: #10b981;
    }

    /* Input States */
    input.error,
    select.error,
    textarea.error {
        border-color: #ef4444;
        background: #fef2f2;
    }

    input.success,
    select.success,
    textarea.success {
        border-color: #10b981;
        background: #ecfdf5;
    }

    input:disabled,
    select:disabled,
    textarea:disabled {
        background: #f3f4f6;
        color: #9ca3af;
        cursor: not-allowed;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
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

    .btn-outline {
        background: transparent;
        border: 2px solid #8b5cf6;
        color: #8b5cf6;
    }

    .btn-outline:hover {
        background: #8b5cf6;
        color: white;
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    .btn-group {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    /* Section Title */
    .section-title {
        font-size: 14px;
        font-weight: 700;
        color: #4c1d95;
        margin: 24px 0 16px;
        padding: 8px 14px;
        background: linear-gradient(90deg, #f3e8ff, transparent);
        border-left: 3px solid #8b5cf6;
        border-radius: 0 6px 6px 0;
    }

    .section-title:first-child {
        margin-top: 0;
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1050;
        animation: fadeIn 0.2s ease;
    }

    .modal-overlay.active {
        display: flex;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 1400px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        animation: slideUp 0.3s ease;
    }

    .modal-header {
        padding: 24px 28px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 28px;
        color: #9ca3af;
        cursor: pointer;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        background: #f3f4f6;
        color: #4b5563;
    }

    .modal-body {
        padding: 28px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-footer {
        padding: 20px 28px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        background: #f9fafb;
        border-radius: 0 0 12px 12px;
    }

    @media (max-width: 768px) {
        .modal-content {
            width: 95%;
            max-height: 95vh;
        }

        .modal-body {
            padding: 16px;
        }

        .modal-header,
        .modal-footer {
            padding: 16px;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Form Components</h1>
    <p class="page-subtitle">Template komponen form untuk pengembangan halaman lainnya</p>
</div>

<form method="POST" action="#">
    @csrf

    <!-- Text Inputs -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">📝 Input Teks</h2>
        </div>
        <div class="card-body">
            <h3 class="section-title">Text, Email, Password</h3>

            <div class="form-row">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input type="email" id="email" name="email" placeholder="nama@email.com" required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" id="password" name="password" placeholder="Masukkan password">
                    </div>
                    <p class="helper-text">Minimal 8 karakter</p>
                </div>

                <div class="form-group">
                    <label for="search">Search</label>
                    <div class="input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="search" id="search" name="search" placeholder="Cari sesuatu...">
                    </div>
                </div>
            </div>

            <h3 class="section-title">Number, Tel, URL</h3>

            <div class="form-row form-row-3">
                <div class="form-group">
                    <label for="number">Number</label>
                    <input type="number" id="number" name="number" placeholder="0" min="0">
                </div>

                <div class="form-group">
                    <label for="tel">Telepon</label>
                    <input type="tel" id="tel" name="tel" placeholder="08123456789">
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" id="url" name="url" placeholder="https://example.com">
                </div>
            </div>

            <h3 class="section-title">Date & Time</h3>

            <div class="form-row form-row-3">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date">
                </div>

                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="time" id="time" name="time">
                </div>

                <div class="form-group">
                    <label for="datetime">DateTime</label>
                    <input type="datetime-local" id="datetime" name="datetime">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="month">Month</label>
                    <input type="month" id="month" name="month">
                </div>

                <div class="form-group">
                    <label for="week">Week</label>
                    <input type="week" id="week" name="week">
                </div>
            </div>
        </div>
    </div>

    <!-- Textarea -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">📄 Textarea</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="description">Deskripsi <span class="required">*</span></label>
                <textarea id="description" name="description" placeholder="Masukkan deskripsi..."></textarea>
            </div>
        </div>
    </div>

    <!-- Select -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">📋 Select / Dropdown</h2>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <label for="select_single">Single Select</label>
                    <select id="select_single" name="select_single">
                        <option value="">Pilih opsi</option>
                        <option value="1">Opsi 1</option>
                        <option value="2">Opsi 2</option>
                        <option value="3">Opsi 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="select_with_icon">Select dengan Icon</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🎓</span>
                        <select id="select_with_icon" name="select_with_icon">
                            <option value="">Pilih fakultas</option>
                            <option value="fk">Fakultas Kedokteran</option>
                            <option value="feb">Fakultas Ekonomi dan Bisnis</option>
                            <option value="fisip">Fakultas Ilmu Sosial dan Politik</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="select_multiple">Multiple Select <span class="label-hint">(Ctrl + Click)</span></label>
                <select id="select_multiple" name="select_multiple[]" multiple>
                    <option value="skill1">Programming</option>
                    <option value="skill2">Design</option>
                    <option value="skill3">Marketing</option>
                    <option value="skill4">Management</option>
                    <option value="skill5">Communication</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Radio Buttons -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">🔘 Radio Buttons</h2>
        </div>
        <div class="card-body">
            <h3 class="section-title">Card Style</h3>

            <div class="form-group">
                <label>Pilih Paket</label>
                <div class="option-group">
                    <label class="radio-item">
                        <input type="radio" name="paket" value="basic">
                        <div class="option-content">
                            <div class="option-label">💡 Basic</div>
                            <div class="option-description">Paket dasar untuk pemula</div>
                        </div>
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="paket" value="pro">
                        <div class="option-content">
                            <div class="option-label">⭐ Pro</div>
                            <div class="option-description">Paket lengkap dengan fitur premium</div>
                        </div>
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="paket" value="enterprise">
                        <div class="option-content">
                            <div class="option-label">🚀 Enterprise</div>
                            <div class="option-description">Untuk kebutuhan bisnis besar</div>
                        </div>
                    </label>
                </div>
            </div>

            <h3 class="section-title">Grid Style</h3>

            <div class="form-group">
                <label>Status</label>
                <div class="option-group grid">
                    <label class="radio-item">
                        <input type="radio" name="status" value="active">
                        <div class="option-content">
                            <div class="option-label">✅ Active</div>
                        </div>
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="status" value="pending">
                        <div class="option-content">
                            <div class="option-label">⏳ Pending</div>
                        </div>
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="status" value="inactive">
                        <div class="option-content">
                            <div class="option-label">❌ Inactive</div>
                        </div>
                    </label>
                </div>
            </div>

            <h3 class="section-title">Simple Inline</h3>

            <div class="form-group">
                <label>Gender</label>
                <div class="option-group horizontal">
                    <label class="simple-option">
                        <input type="radio" name="gender" value="male"> Laki-laki
                    </label>
                    <label class="simple-option">
                        <input type="radio" name="gender" value="female"> Perempuan
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkboxes -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">☑️ Checkboxes</h2>
        </div>
        <div class="card-body">
            <h3 class="section-title">Card Style</h3>

            <div class="form-group">
                <label>Fitur yang Diinginkan</label>
                <div class="option-group">
                    <label class="checkbox-item">
                        <input type="checkbox" name="features[]" value="analytics">
                        <div class="option-content">
                            <div class="option-label">📊 Analytics</div>
                            <div class="option-description">Dashboard analitik lengkap</div>
                        </div>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="features[]" value="reports">
                        <div class="option-content">
                            <div class="option-label">📈 Reports</div>
                            <div class="option-description">Laporan otomatis</div>
                        </div>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="features[]" value="api">
                        <div class="option-content">
                            <div class="option-label">🔌 API Access</div>
                            <div class="option-description">Akses API untuk integrasi</div>
                        </div>
                    </label>
                </div>
            </div>

            <h3 class="section-title">Simple Inline</h3>

            <div class="form-group">
                <label>Hari Aktif</label>
                <div class="option-group horizontal">
                    <label class="simple-option"><input type="checkbox" name="days[]" value="mon"> Senin</label>
                    <label class="simple-option"><input type="checkbox" name="days[]" value="tue"> Selasa</label>
                    <label class="simple-option"><input type="checkbox" name="days[]" value="wed"> Rabu</label>
                    <label class="simple-option"><input type="checkbox" name="days[]" value="thu"> Kamis</label>
                    <label class="simple-option"><input type="checkbox" name="days[]" value="fri"> Jumat</label>
                </div>
            </div>

            <h3 class="section-title">Agreement</h3>

            <div class="form-group">
                <label class="checkbox-item">
                    <input type="checkbox" name="terms" value="1" required>
                    <div class="option-content">
                        <div class="option-label">Saya menyetujui syarat dan ketentuan</div>
                        <div class="option-description">Dengan mencentang ini, saya menyatakan telah membaca dan menyetujui <a href="#" style="color: #8b5cf6;">syarat dan ketentuan</a>.</div>
                    </div>
                </label>
            </div>
        </div>
    </div>

    <!-- Range, Rating, Scale -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">⭐ Range, Rating & Scale</h2>
        </div>
        <div class="card-body">
            <h3 class="section-title">Range Slider</h3>

            <div class="form-group">
                <label for="budget">Budget (Rp)</label>
                <input type="range" id="budget" name="budget" min="0" max="100" value="50" oninput="document.getElementById('budget_value').textContent = this.value">
                <div class="range-labels">
                    <span>0</span>
                    <span>100 Juta</span>
                </div>
                <div class="range-value"><span id="budget_value">50</span> Juta</div>
            </div>

            <h3 class="section-title">Star Rating</h3>

            <div class="form-group">
                <label>Rating</label>
                <div class="rating-container" id="star-rating">
                    <span class="rating-star" data-value="1">★</span>
                    <span class="rating-star" data-value="2">★</span>
                    <span class="rating-star" data-value="3">★</span>
                    <span class="rating-star" data-value="4">★</span>
                    <span class="rating-star" data-value="5">★</span>
                </div>
                <input type="hidden" name="rating" id="rating" value="">
            </div>

            <h3 class="section-title">Numeric Scale (1-10)</h3>

            <div class="form-group">
                <label>Tingkat Kepuasan</label>
                <div class="scale-rating" id="nps-scale">
                    <div class="scale-item" data-value="1">1</div>
                    <div class="scale-item" data-value="2">2</div>
                    <div class="scale-item" data-value="3">3</div>
                    <div class="scale-item" data-value="4">4</div>
                    <div class="scale-item" data-value="5">5</div>
                    <div class="scale-item" data-value="6">6</div>
                    <div class="scale-item" data-value="7">7</div>
                    <div class="scale-item" data-value="8">8</div>
                    <div class="scale-item" data-value="9">9</div>
                    <div class="scale-item" data-value="10">10</div>
                </div>
                <div class="range-labels mt-1">
                    <span>Sangat Tidak Puas</span>
                    <span>Sangat Puas</span>
                </div>
                <input type="hidden" name="satisfaction" id="satisfaction" value="">
            </div>
        </div>
    </div>

    <!-- Toggle & Special -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">🎛️ Toggle & Input Khusus</h2>
        </div>
        <div class="card-body">
            <h3 class="section-title">Toggle Switch</h3>

            <div class="form-group">
                <div class="toggle-container">
                    <div class="toggle" id="toggle-notifications" onclick="this.classList.toggle('active')"></div>
                    <span class="toggle-label">Aktifkan notifikasi email</span>
                </div>
            </div>

            <div class="form-group">
                <div class="toggle-container">
                    <div class="toggle active" id="toggle-public" onclick="this.classList.toggle('active')"></div>
                    <span class="toggle-label">Profil publik</span>
                </div>
            </div>

            <h3 class="section-title">Color Picker</h3>

            <div class="form-group">
                <label for="color">Pilih Warna</label>
                <div class="color-picker-wrapper">
                    <input type="color" id="color" name="color" value="#8b5cf6" onchange="document.getElementById('color_val').textContent = this.value;">
                    <span class="color-value" id="color_val">#8b5cf6</span>
                </div>
            </div>
        </div>
    </div>

    <!-- File Upload -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">📁 File Upload</h2>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Upload Gambar</label>
                    <div class="file-upload">
                        <input type="file" name="image" accept="image/*">
                        <div class="file-upload-icon">📷</div>
                        <div class="file-upload-text">Drag & drop atau klik untuk upload</div>
                        <div class="file-upload-hint">JPG, PNG (Max 2MB)</div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Upload Dokumen</label>
                    <div class="file-upload">
                        <input type="file" name="documents[]" multiple accept=".pdf,.doc,.docx">
                        <div class="file-upload-icon">📄</div>
                        <div class="file-upload-text">Upload multiple files</div>
                        <div class="file-upload-hint">PDF, DOC, DOCX (Max 5MB)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation States -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">✅ Validation States</h2>
        </div>
        <div class="card-body">
            <div class="form-row form-row-3">
                <div class="form-group">
                    <label>Error State</label>
                    <input type="text" class="error" value="Invalid input">
                    <p class="helper-text error-text">Terdapat kesalahan pada input</p>
                </div>

                <div class="form-group">
                    <label>Success State</label>
                    <input type="text" class="success" value="Valid input">
                    <p class="helper-text success-text">Input valid</p>
                </div>

                <div class="form-group">
                    <label>Disabled State</label>
                    <input type="text" value="Cannot edit" disabled>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">🎯 Buttons</h2>
        </div>
        <div class="card-body">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary">Cancel</button>
                <button type="button" class="btn btn-outline">Save Draft</button>
                <button type="button" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-success">✓ Approve</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-primary" onclick="openExtraLargeModal()">📱 Buka Modal XL</button>
            </div>
        </div>
    </div>

</form>

<!-- Modal Extra Large -->
<div class="modal-overlay" id="extraLargeModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">📱 Modal Extra Large</h2>
            <button type="button" class="modal-close" onclick="closeExtraLargeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p style="margin-bottom: 16px; color: #374151; line-height: 1.6;">
                Ini adalah modal dengan ukuran extra large (XL). Modal ini dapat menampilkan konten yang lebih luas dan detail.
            </p>
            
            <div style="background: #f3e8ff; border-left: 4px solid #8b5cf6; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                <h3 style="margin: 0 0 8px 0; color: #4c1d95; font-size: 14px; font-weight: 600;">
                    💡 Tips Penggunaan
                </h3>
                <ul style="margin: 0; padding-left: 20px; color: #6b7280; font-size: 14px;">
                    <li>Modal XL cocok untuk menampilkan tabel besar atau formulir kompleks</li>
                    <li>Gunakan untuk presentasi data yang memerlukan ruang ekstra</li>
                    <li>Modal responsif dan akan beradaptasi di perangkat mobile</li>
                </ul>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <div style="background: #ecfdf5; padding: 16px; border-radius: 8px;">
                    <h4 style="margin: 0 0 8px 0; color: #065f46; font-weight: 600; font-size: 14px;">✅ Keuntungan</h4>
                    <p style="margin: 0; color: #047857; font-size: 13px;">Luas layar memberikan pengalaman pengguna yang lebih baik untuk konten kompleks.</p>
                </div>
                <div style="background: #fef2f2; padding: 16px; border-radius: 8px;">
                    <h4 style="margin: 0 0 8px 0; color: #7f1d1d; font-weight: 600; font-size: 14px;">⚠️ Catatan</h4>
                    <p style="margin: 0; color: #991b1b; font-size: 13px;">Pastikan konten tetap readable pada perangkat kecil.</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeExtraLargeModal()">Tutup</button>
            <button type="button" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Star Rating
    const stars = document.querySelectorAll('#star-rating .rating-star');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = this.dataset.value;
            document.getElementById('rating').value = value;
            stars.forEach((s, i) => s.classList.toggle('active', i < value));
        });
    });

    // NPS Scale
    const scaleItems = document.querySelectorAll('#nps-scale .scale-item');
    scaleItems.forEach(item => {
        item.addEventListener('click', function() {
            document.getElementById('satisfaction').value = this.dataset.value;
            scaleItems.forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Radio & Checkbox selection visual
    document.querySelectorAll('.radio-item input, .checkbox-item input').forEach(input => {
        input.addEventListener('change', function() {
            if (this.type === 'radio') {
                document.querySelectorAll(`input[name="${this.name}"]`).forEach(r => {
                    r.closest('.radio-item')?.classList.remove('selected');
                });
            }
            if (this.checked) {
                this.closest('.radio-item, .checkbox-item')?.classList.add('selected');
            } else {
                this.closest('.checkbox-item')?.classList.remove('selected');
            }
        });
    });

    // Modal Functions
    function openExtraLargeModal() {
        document.getElementById('extraLargeModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeExtraLargeModal() {
        document.getElementById('extraLargeModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking on overlay
    document.getElementById('extraLargeModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeExtraLargeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('extraLargeModal').classList.contains('active')) {
            closeExtraLargeModal();
        }
    });
</script>
@endsection
