<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey - Airlangga Youth Entrepreneur</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            padding: 40px 20px;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -200px;
            right: -150px;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite reverse;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .header-logo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.15);
            padding: 12px 24px;
            border-radius: 50px;
        }

        .header-logo-icon {
            font-size: 28px;
        }

        .header-logo-text {
            font-size: 18px;
            font-weight: 700;
        }

        .header h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Progress Bar */
        .progress-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            height: 10px;
            margin-bottom: 40px;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, #fcd34d, #fbbf24);
            height: 100%;
            width: 25%;
            border-radius: 50px;
            transition: width 0.5s ease;
        }

        .progress-text {
            text-align: center;
            color: white;
            font-size: 14px;
            margin-top: 10px;
            opacity: 0.9;
        }

        /* Card */
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
            margin-bottom: 30px;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f3f4f6;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e1b4b;
        }

        .card-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* Section Title */
        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #4c1d95;
            margin: 30px 0 20px;
            padding: 10px 16px;
            background: linear-gradient(90deg, #f3e8ff, transparent);
            border-left: 4px solid #8b5cf6;
            border-radius: 0 8px 8px 0;
        }

        .section-title:first-of-type {
            margin-top: 0;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Labels */
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
            font-size: 13px;
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
            width: 20px;
            height: 20px;
            color: #9ca3af;
            pointer-events: none;
        }

        .input-wrapper .input-icon {
            font-size: 18px;
            width: auto;
            height: auto;
        }

        .input-wrapper input,
        .input-wrapper select {
            padding-left: 46px;
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
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
            background: #f9fafb;
            color: #1f2937;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #8b5cf6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }

        input::placeholder,
        textarea::placeholder {
            color: #9ca3af;
        }

        /* Textarea */
        textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        textarea.small {
            min-height: 80px;
        }

        /* Select */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 20px;
            padding-right: 48px;
            cursor: pointer;
        }

        select[multiple] {
            background-image: none;
            padding: 12px;
            min-height: 140px;
        }

        select[multiple] option {
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 4px;
        }

        select[multiple] option:checked {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
        }

        /* Radio & Checkbox Group */
        .option-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option-group.horizontal {
            flex-direction: row;
            flex-wrap: wrap;
            gap: 16px;
        }

        .option-group.grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        /* Custom Radio */
        .radio-item,
        .checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
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
            width: 20px;
            height: 20px;
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
            margin-bottom: 2px;
        }

        .option-description {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.4;
        }

        /* Simple Radio/Checkbox (inline) */
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
        .range-container {
            padding: 10px 0;
        }

        input[type="range"] {
            width: 100%;
            height: 8px;
            border-radius: 10px;
            background: #e5e7eb;
            appearance: none;
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(139, 92, 246, 0.4);
            transition: transform 0.2s;
        }

        input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.1);
        }

        input[type="range"]::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            cursor: pointer;
            border: none;
        }

        .range-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 13px;
            color: #6b7280;
        }

        .range-value {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #8b5cf6;
            margin-top: 10px;
        }

        /* File Upload */
        .file-upload {
            position: relative;
            border: 2px dashed #d1d5db;
            border-radius: 16px;
            padding: 40px 20px;
            text-align: center;
            background: #f9fafb;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload:hover {
            border-color: #8b5cf6;
            background: #faf5ff;
        }

        .file-upload.dragover {
            border-color: #8b5cf6;
            background: #f3e8ff;
        }

        .file-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .file-upload-text {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .file-upload-hint {
            font-size: 13px;
            color: #9ca3af;
        }

        .file-upload-btn {
            display: inline-block;
            margin-top: 16px;
            padding: 10px 24px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Color Picker */
        .color-picker-wrapper {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        input[type="color"] {
            width: 60px;
            height: 60px;
            padding: 4px;
            border-radius: 12px;
            cursor: pointer;
        }

        .color-value {
            font-family: monospace;
            font-size: 16px;
            color: #4b5563;
            background: #f3f4f6;
            padding: 8px 16px;
            border-radius: 8px;
        }

        /* Rating Stars */
        .rating-container {
            display: flex;
            gap: 8px;
        }

        .rating-star {
            font-size: 36px;
            cursor: pointer;
            transition: transform 0.2s;
            color: #d1d5db;
        }

        .rating-star:hover {
            transform: scale(1.2);
        }

        .rating-star.active {
            color: #fbbf24;
        }

        /* Scale Rating (1-10) */
        .scale-rating {
            display: flex;
            gap: 8px;
        }

        .scale-item {
            width: 44px;
            height: 44px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
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

        .scale-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 13px;
            color: #6b7280;
        }

        /* Toggle Switch */
        .toggle-container {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .toggle {
            position: relative;
            width: 56px;
            height: 30px;
            background: #d1d5db;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .toggle.active {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
        }

        .toggle.active::after {
            transform: translateX(26px);
        }

        .toggle-label {
            font-size: 15px;
            color: #374151;
        }

        /* Helper Text & Validation */
        .helper-text {
            margin-top: 8px;
            font-size: 13px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .helper-text svg {
            width: 16px;
            height: 16px;
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

        /* Disabled State */
        input:disabled,
        select:disabled,
        textarea:disabled {
            background: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
        }

        /* Buttons */
        .btn-group {
            display: flex;
            gap: 16px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f3f4f6;
        }

        .btn {
            flex: 1;
            border: 0;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            padding: 16px 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.5);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
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

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            color: white;
            opacity: 0.8;
            font-size: 14px;
        }

        .footer a {
            color: #fcd34d;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .header h1 {
                font-size: 28px;
            }

            .card {
                padding: 24px;
            }

            .btn-group {
                flex-direction: column;
            }

            .scale-rating {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="header-logo">
                <span class="header-logo-icon">🚀</span>
                <span class="header-logo-text">AYE Program</span>
            </div>
            <h1>Survey Peserta Program</h1>
            <p>Bantu kami memahami kebutuhan dan harapan kamu sebagai calon entrepreneur muda Universitas Airlangga.</p>
        </header>

        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-bar" style="width: 25%;"></div>
        </div>
        <p class="progress-text">Langkah 1 dari 4 - Data Pribadi</p>

        <form method="POST" action="#">
            @csrf

            <!-- SECTION 1: Text Inputs -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📝</div>
                    <div>
                        <h2 class="card-title">Input Teks</h2>
                        <p class="card-subtitle">Berbagai jenis input teks standar</p>
                    </div>
                </div>

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
                            <input type="email" id="email" name="email" placeholder="nama@student.unair.ac.id" required>
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
                        <p class="helper-text">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Minimal 8 karakter dengan kombinasi huruf dan angka
                        </p>
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

                <div class="form-row">
                    <div class="form-group">
                        <label for="umur">Umur</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🎂</span>
                            <input type="number" id="umur" name="umur" placeholder="18" min="17" max="30">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <input type="tel" id="telepon" name="telepon" placeholder="08123456789">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="website">Website / Portfolio</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <input type="url" id="website" name="website" placeholder="https://portfolio.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="linkedin">LinkedIn <span class="label-hint">(opsional)</span></label>
                        <div class="input-wrapper">
                            <span class="input-icon">💼</span>
                            <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>
                </div>

                <h3 class="section-title">Date & Time</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir">
                    </div>

                    <div class="form-group">
                        <label for="waktu">Waktu Fleksibel</label>
                        <input type="time" id="waktu" name="waktu">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jadwal">Jadwal Meeting</label>
                        <input type="datetime-local" id="jadwal" name="jadwal">
                    </div>

                    <div class="form-group">
                        <label for="bulan">Bulan Mulai Program</label>
                        <input type="month" id="bulan" name="bulan">
                    </div>
                </div>

                <div class="form-group">
                    <label for="minggu">Minggu Aktivitas</label>
                    <input type="week" id="minggu" name="minggu" style="max-width: 300px;">
                </div>
            </div>

            <!-- SECTION 2: Textarea -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📄</div>
                    <div>
                        <h2 class="card-title">Textarea</h2>
                        <p class="card-subtitle">Input teks panjang / multi-baris</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="motivasi">Motivasi Mengikuti Program <span class="required">*</span></label>
                    <textarea id="motivasi" name="motivasi" placeholder="Ceritakan alasan kamu ingin bergabung dengan program Airlangga Youth Entrepreneur..." required></textarea>
                    <p class="helper-text">Minimal 100 karakter</p>
                </div>

                <div class="form-group">
                    <label for="ide_bisnis">Ide Bisnis Singkat</label>
                    <textarea id="ide_bisnis" name="ide_bisnis" class="small" placeholder="Deskripsikan ide bisnis kamu secara singkat..."></textarea>
                </div>
            </div>

            <!-- SECTION 3: Select / Dropdown -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📋</div>
                    <div>
                        <h2 class="card-title">Select / Dropdown</h2>
                        <p class="card-subtitle">Pilihan tunggal dan pilihan ganda</p>
                    </div>
                </div>

                <h3 class="section-title">Single Select</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="fakultas">Fakultas <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <span class="input-icon">🎓</span>
                            <select id="fakultas" name="fakultas" required>
                                <option value="">Pilih Fakultas</option>
                                <option value="fk">Fakultas Kedokteran</option>
                                <option value="fkg">Fakultas Kedokteran Gigi</option>
                                <option value="fh">Fakultas Hukum</option>
                                <option value="feb">Fakultas Ekonomi dan Bisnis</option>
                                <option value="ff">Fakultas Farmasi</option>
                                <option value="fkp">Fakultas Keperawatan</option>
                                <option value="fisip">Fakultas Ilmu Sosial dan Ilmu Politik</option>
                                <option value="fst">Fakultas Sains dan Teknologi</option>
                                <option value="fib">Fakultas Ilmu Budaya</option>
                                <option value="fkm">Fakultas Kesehatan Masyarakat</option>
                                <option value="fpk">Fakultas Perikanan dan Kelautan</option>
                                <option value="fpsikologi">Fakultas Psikologi</option>
                                <option value="fvokasi">Fakultas Vokasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                    </div>
                </div>

                <h3 class="section-title">Multiple Select</h3>

                <div class="form-group">
                    <label for="keahlian">Keahlian yang Dimiliki <span class="label-hint">(pilih beberapa)</span></label>
                    <select id="keahlian" name="keahlian[]" multiple>
                        <option value="coding">Programming / Coding</option>
                        <option value="design">Graphic Design</option>
                        <option value="marketing">Digital Marketing</option>
                        <option value="content">Content Creation</option>
                        <option value="video">Video Editing</option>
                        <option value="public_speaking">Public Speaking</option>
                        <option value="finance">Financial Management</option>
                        <option value="leadership">Leadership</option>
                    </select>
                    <p class="helper-text">Tekan Ctrl (Cmd di Mac) + Klik untuk memilih beberapa opsi</p>
                </div>
            </div>

            <!-- SECTION 4: Radio Buttons -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">🔘</div>
                    <div>
                        <h2 class="card-title">Radio Buttons</h2>
                        <p class="card-subtitle">Pilihan tunggal dengan berbagai tampilan</p>
                    </div>
                </div>

                <h3 class="section-title">Card Style Radio</h3>

                <div class="form-group">
                    <label>Bidang Bisnis yang Diminati <span class="required">*</span></label>
                    <div class="option-group">
                        <label class="radio-item">
                            <input type="radio" name="bidang_bisnis" value="teknologi" required>
                            <div class="option-content">
                                <div class="option-label">💻 Teknologi & Startup</div>
                                <div class="option-description">Aplikasi, SaaS, AI, IoT, dan solusi digital</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="bidang_bisnis" value="fnb">
                            <div class="option-content">
                                <div class="option-label">🍔 Food & Beverage</div>
                                <div class="option-description">Kuliner, restoran, katering, dan produk makanan</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="bidang_bisnis" value="fashion">
                            <div class="option-content">
                                <div class="option-label">👗 Fashion & Lifestyle</div>
                                <div class="option-description">Pakaian, aksesoris, kecantikan, dan gaya hidup</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="bidang_bisnis" value="kreatif">
                            <div class="option-content">
                                <div class="option-label">🎨 Industri Kreatif</div>
                                <div class="option-description">Desain, konten, media, dan entertainment</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="bidang_bisnis" value="sosial">
                            <div class="option-content">
                                <div class="option-label">🌱 Social Enterprise</div>
                                <div class="option-description">Bisnis dengan dampak sosial dan lingkungan</div>
                            </div>
                        </label>
                    </div>
                </div>

                <h3 class="section-title">Grid Style Radio</h3>

                <div class="form-group">
                    <label>Tahap Pengembangan Bisnis Saat Ini</label>
                    <div class="option-group grid">
                        <label class="radio-item">
                            <input type="radio" name="tahap_bisnis" value="ide">
                            <div class="option-content">
                                <div class="option-label">💡 Ide</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="tahap_bisnis" value="validasi">
                            <div class="option-content">
                                <div class="option-label">🔍 Validasi</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="tahap_bisnis" value="mvp">
                            <div class="option-content">
                                <div class="option-label">🛠️ MVP</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="tahap_bisnis" value="launch">
                            <div class="option-content">
                                <div class="option-label">🚀 Launched</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="tahap_bisnis" value="growth">
                            <div class="option-content">
                                <div class="option-label">📈 Growth</div>
                            </div>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="tahap_bisnis" value="scale">
                            <div class="option-content">
                                <div class="option-label">🏆 Scale</div>
                            </div>
                        </label>
                    </div>
                </div>

                <h3 class="section-title">Simple Inline Radio</h3>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="option-group horizontal">
                        <label class="simple-option">
                            <input type="radio" name="gender" value="laki">
                            Laki-laki
                        </label>
                        <label class="simple-option">
                            <input type="radio" name="gender" value="perempuan">
                            Perempuan
                        </label>
                        <label class="simple-option">
                            <input type="radio" name="gender" value="other">
                            Prefer not to say
                        </label>
                    </div>
                </div>
            </div>

            <!-- SECTION 5: Checkboxes -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">☑️</div>
                    <div>
                        <h2 class="card-title">Checkboxes</h2>
                        <p class="card-subtitle">Pilihan ganda dengan berbagai tampilan</p>
                    </div>
                </div>

                <h3 class="section-title">Card Style Checkbox</h3>

                <div class="form-group">
                    <label>Fasilitas Program yang Diharapkan <span class="label-hint">(pilih semua yang sesuai)</span></label>
                    <div class="option-group">
                        <label class="checkbox-item">
                            <input type="checkbox" name="fasilitas[]" value="mentoring">
                            <div class="option-content">
                                <div class="option-label">👨‍🏫 Mentoring 1-on-1</div>
                                <div class="option-description">Bimbingan personal dari mentor berpengalaman</div>
                            </div>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="fasilitas[]" value="workshop">
                            <div class="option-content">
                                <div class="option-label">🎯 Workshop Intensif</div>
                                <div class="option-description">Pelatihan praktis dengan materi terkini</div>
                            </div>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="fasilitas[]" value="networking">
                            <div class="option-content">
                                <div class="option-label">🤝 Networking Event</div>
                                <div class="option-description">Kesempatan bertemu investor dan pengusaha</div>
                            </div>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="fasilitas[]" value="funding">
                            <div class="option-content">
                                <div class="option-label">💰 Akses Pendanaan</div>
                                <div class="option-description">Kesempatan pitching ke investor</div>
                            </div>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="fasilitas[]" value="coworking">
                            <div class="option-content">
                                <div class="option-label">🏢 Co-working Space</div>
                                <div class="option-description">Akses ruang kerja bersama yang nyaman</div>
                            </div>
                        </label>
                    </div>
                </div>

                <h3 class="section-title">Simple Inline Checkbox</h3>

                <div class="form-group">
                    <label>Hari yang Tersedia untuk Kegiatan</label>
                    <div class="option-group horizontal">
                        <label class="simple-option">
                            <input type="checkbox" name="hari[]" value="senin">
                            Senin
                        </label>
                        <label class="simple-option">
                            <input type="checkbox" name="hari[]" value="selasa">
                            Selasa
                        </label>
                        <label class="simple-option">
                            <input type="checkbox" name="hari[]" value="rabu">
                            Rabu
                        </label>
                        <label class="simple-option">
                            <input type="checkbox" name="hari[]" value="kamis">
                            Kamis
                        </label>
                        <label class="simple-option">
                            <input type="checkbox" name="hari[]" value="jumat">
                            Jumat
                        </label>
                        <label class="simple-option">
                            <input type="checkbox" name="hari[]" value="sabtu">
                            Sabtu
                        </label>
                    </div>
                </div>

                <h3 class="section-title">Single Checkbox (Agreement)</h3>

                <div class="form-group">
                    <label class="checkbox-item">
                        <input type="checkbox" name="terms" value="1" required>
                        <div class="option-content">
                            <div class="option-label">Saya menyetujui syarat dan ketentuan</div>
                            <div class="option-description">Dengan mencentang ini, saya menyatakan telah membaca dan menyetujui <a href="#" style="color: #8b5cf6;">syarat dan ketentuan</a> program.</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- SECTION 6: Range, Rating, Scale -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">⭐</div>
                    <div>
                        <h2 class="card-title">Range, Rating & Scale</h2>
                        <p class="card-subtitle">Input nilai dengan slider dan skala</p>
                    </div>
                </div>

                <h3 class="section-title">Range Slider</h3>

                <div class="form-group">
                    <label for="jam_komitmen">Jam Komitmen per Minggu</label>
                    <div class="range-container">
                        <input type="range" id="jam_komitmen" name="jam_komitmen" min="0" max="40" value="10" oninput="document.getElementById('jam_value').textContent = this.value">
                        <div class="range-labels">
                            <span>0 jam</span>
                            <span>40 jam</span>
                        </div>
                        <div class="range-value"><span id="jam_value">10</span> jam</div>
                    </div>
                </div>

                <h3 class="section-title">Star Rating</h3>

                <div class="form-group">
                    <label>Seberapa Siap Mental Anda Menjadi Entrepreneur?</label>
                    <div class="rating-container" id="star-rating">
                        <span class="rating-star" data-value="1">★</span>
                        <span class="rating-star" data-value="2">★</span>
                        <span class="rating-star" data-value="3">★</span>
                        <span class="rating-star" data-value="4">★</span>
                        <span class="rating-star" data-value="5">★</span>
                    </div>
                    <input type="hidden" name="kesiapan_mental" id="kesiapan_mental" value="">
                </div>

                <h3 class="section-title">Numeric Scale (NPS Style)</h3>

                <div class="form-group">
                    <label>Seberapa besar kemungkinan Anda merekomendasikan program ini?</label>
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
                    <div class="scale-labels">
                        <span>Sangat Tidak Mungkin</span>
                        <span>Sangat Mungkin</span>
                    </div>
                    <input type="hidden" name="nps_score" id="nps_score" value="">
                </div>
            </div>

            <!-- SECTION 7: Toggle & Special -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">🎛️</div>
                    <div>
                        <h2 class="card-title">Toggle & Input Khusus</h2>
                        <p class="card-subtitle">Switch toggle, color picker, dan lainnya</p>
                    </div>
                </div>

                <h3 class="section-title">Toggle Switch</h3>

                <div class="form-group">
                    <div class="toggle-container">
                        <div class="toggle" id="toggle-newsletter" onclick="this.classList.toggle('active'); document.getElementById('newsletter').value = this.classList.contains('active') ? '1' : '0';"></div>
                        <span class="toggle-label">Berlangganan newsletter dan update program</span>
                        <input type="hidden" name="newsletter" id="newsletter" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <div class="toggle-container">
                        <div class="toggle active" id="toggle-whatsapp" onclick="this.classList.toggle('active'); document.getElementById('join_whatsapp').value = this.classList.contains('active') ? '1' : '0';"></div>
                        <span class="toggle-label">Bergabung dengan grup WhatsApp komunitas</span>
                        <input type="hidden" name="join_whatsapp" id="join_whatsapp" value="1">
                    </div>
                </div>

                <h3 class="section-title">Color Picker</h3>

                <div class="form-group">
                    <label for="brand_color">Warna Brand Bisnis Anda</label>
                    <div class="color-picker-wrapper">
                        <input type="color" id="brand_color" name="brand_color" value="#8b5cf6" onchange="document.getElementById('color_value').textContent = this.value;">
                        <span class="color-value" id="color_value">#8b5cf6</span>
                    </div>
                </div>

                <h3 class="section-title">Hidden Input</h3>

                <div class="form-group">
                    <p class="helper-text">Hidden input tidak terlihat di UI, digunakan untuk data tersembunyi:</p>
                    <input type="hidden" name="source" value="survey_form">
                    <input type="hidden" name="form_version" value="1.0">
                    <code style="background: #f3f4f6; padding: 12px; border-radius: 8px; display: block; font-size: 13px; color: #6b7280;">
                        &lt;input type="hidden" name="source" value="survey_form"&gt;<br>
                        &lt;input type="hidden" name="form_version" value="1.0"&gt;
                    </code>
                </div>
            </div>

            <!-- SECTION 8: File Upload -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📁</div>
                    <div>
                        <h2 class="card-title">File Upload</h2>
                        <p class="card-subtitle">Upload dokumen dan gambar</p>
                    </div>
                </div>

                <h3 class="section-title">Drag & Drop Area</h3>

                <div class="form-group">
                    <label>Upload Foto Profil</label>
                    <div class="file-upload" id="dropzone-foto">
                        <input type="file" id="foto" name="foto" accept="image/*">
                        <div class="file-upload-icon">📷</div>
                        <div class="file-upload-text">Drag & drop foto di sini</div>
                        <div class="file-upload-hint">atau klik untuk memilih file</div>
                        <span class="file-upload-btn">Pilih File</span>
                    </div>
                    <p class="helper-text">Format: JPG, PNG. Maksimal 2MB.</p>
                </div>

                <h3 class="section-title">Multiple Files</h3>

                <div class="form-group">
                    <label>Upload Dokumen Pendukung</label>
                    <div class="file-upload">
                        <input type="file" id="dokumen" name="dokumen[]" multiple accept=".pdf,.doc,.docx">
                        <div class="file-upload-icon">📄</div>
                        <div class="file-upload-text">Upload dokumen pendukung</div>
                        <div class="file-upload-hint">CV, proposal bisnis, sertifikat</div>
                        <span class="file-upload-btn">Pilih Files</span>
                    </div>
                    <p class="helper-text">Format: PDF, DOC, DOCX. Maksimal 5MB per file.</p>
                </div>
            </div>

            <!-- SECTION 9: Validation States -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">✅</div>
                    <div>
                        <h2 class="card-title">Validation States</h2>
                        <p class="card-subtitle">Contoh tampilan error dan success</p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="input_error">Input dengan Error</label>
                        <input type="text" id="input_error" class="error" value="invalid@email" placeholder="Email tidak valid">
                        <p class="helper-text error-text">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Format email tidak valid
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="input_success">Input dengan Success</label>
                        <input type="text" id="input_success" class="success" value="valid@email.com" placeholder="Email valid">
                        <p class="helper-text success-text">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Email tersedia
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input_disabled">Input Disabled</label>
                    <input type="text" id="input_disabled" value="Tidak dapat diedit" disabled style="max-width: 400px;">
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">🎯</div>
                    <div>
                        <h2 class="card-title">Tombol Aksi</h2>
                        <p class="card-subtitle">Berbagai style tombol</p>
                    </div>
                </div>

                <div class="btn-group" style="border-top: none; padding-top: 0; margin-top: 0;">
                    <button type="button" class="btn btn-secondary">
                        ← Kembali
                    </button>
                    <button type="button" class="btn btn-outline">
                        Simpan Draft
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Kirim Survey →
                    </button>
                </div>
            </div>

        </form>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2026 Airlangga Youth Entrepreneur Program · <a href="#">Bantuan</a> · <a href="#">Kontak</a></p>
        </footer>
    </div>

    <script>
        // Star Rating
        const stars = document.querySelectorAll('#star-rating .rating-star');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.dataset.value;
                document.getElementById('kesiapan_mental').value = value;
                stars.forEach((s, i) => {
                    s.classList.toggle('active', i < value);
                });
            });
            star.addEventListener('mouseenter', function() {
                const value = this.dataset.value;
                stars.forEach((s, i) => {
                    s.style.color = i < value ? '#fbbf24' : '#d1d5db';
                });
            });
        });
        document.getElementById('star-rating').addEventListener('mouseleave', function() {
            const currentValue = document.getElementById('kesiapan_mental').value || 0;
            stars.forEach((s, i) => {
                s.style.color = i < currentValue ? '#fbbf24' : '#d1d5db';
            });
        });

        // NPS Scale
        const scaleItems = document.querySelectorAll('#nps-scale .scale-item');
        scaleItems.forEach(item => {
            item.addEventListener('click', function() {
                const value = this.dataset.value;
                document.getElementById('nps_score').value = value;
                scaleItems.forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // File Upload Drag & Drop
        const dropzones = document.querySelectorAll('.file-upload');
        dropzones.forEach(zone => {
            zone.addEventListener('dragover', (e) => {
                e.preventDefault();
                zone.classList.add('dragover');
            });
            zone.addEventListener('dragleave', () => {
                zone.classList.remove('dragover');
            });
            zone.addEventListener('drop', (e) => {
                e.preventDefault();
                zone.classList.remove('dragover');
                const input = zone.querySelector('input[type="file"]');
                if (input && e.dataTransfer.files.length) {
                    input.files = e.dataTransfer.files;
                }
            });
        });

        // Radio & Checkbox card selection visual
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
    </script>
</body>
</html>
