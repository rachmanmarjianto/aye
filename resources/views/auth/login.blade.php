<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Airlangga Youth Entrepreneur</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -200px;
            right: -150px;
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 580px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .hero {
            flex: 1;
            background: linear-gradient(145deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -80px;
            right: -80px;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .hero h1 {
            font-size: 36px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero h1 span {
            background: linear-gradient(90deg, #fcd34d, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-section {
            flex: 1;
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 35px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1e1b4b;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #6b7280;
            font-size: 15px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #9ca3af;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 14px 14px 46px;
            font-size: 15px;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        input:focus {
            border-color: #8b5cf6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }

        input::placeholder {
            color: #9ca3af;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0 25px;
            font-size: 14px;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #4b5563;
            cursor: pointer;
        }

        .remember input {
            width: 18px;
            height: 18px;
            accent-color: #8b5cf6;
            cursor: pointer;
        }

        .link {
            color: #8b5cf6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .link:hover {
            color: #7c3aed;
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
            color: white;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.5);
        }

        .btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #9ca3af;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 15px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 450px;
            }

            .hero {
                padding: 35px 30px;
            }

            .hero h1 {
                font-size: 26px;
            }

            .features {
                display: none;
            }

            .form-section {
                padding: 35px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <div class="hero-content">
                <div class="logo">
                    <div class="logo-icon">🚀</div>
                    <div class="logo-text">AYE Program</div>
                </div>

                <h1>Bangun Mimpimu,<br><span>Jadi Entrepreneur!</span></h1>

                <p>Bergabunglah dengan ribuan mahasiswa Universitas Airlangga dalam program pengembangan kewirausahaan yang akan membawamu ke level berikutnya.</p>

                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">💡</div>
                        <span>Mentoring dari pengusaha sukses</span>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🎯</div>
                        <span>Workshop & pelatihan bisnis</span>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🏆</div>
                        <span>Kesempatan pendanaan startup</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-header">
                <h2>Selamat Datang! 👋</h2>
                <p>Gunakan akun Cybercampus untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('login')}}" id="login-form">
                @csrf

                <div class="field">
                    <label for="email">NIP/NIK/NIM</label>
                    <div class="input-wrapper">
                        <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15C8.8299 15 6.01077 16.5306 4.21597 18.906C3.82968 19.4172 3.63653 19.6728 3.64285 20.0183C3.64773 20.2852 3.81533 20.6219 4.02534 20.7867C4.29716 21 4.67384 21 5.4272 21H18.5727C19.3261 21 19.7028 21 19.9746 20.7867C20.1846 20.6219 20.3522 20.2852 20.3571 20.0183C20.3634 19.6728 20.1703 19.4172 19.784 18.906C17.9892 16.5306 15.17 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 12C14.4853 12 16.5 9.98528 16.5 7.5C16.5 5.01472 14.4853 3 12 3C9.51469 3 7.49997 5.01472 7.49997 7.5C7.49997 9.98528 9.51469 12 12 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input id="email" type="text" name="username" placeholder="" required autofocus>
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input id="password" type="password" name="password" placeholder="" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="captcha">CAPTCHA</label>
                    <img src="{{ captcha_src(6) }}" alt="CAPTCHA" style="border: 1px solid #ccc;" id="captcha-image">
                    <span style="font-size: 12px; color:red; padding-left:10px; cursor:pointer" onclick="reloadCaptcha()">klik saya jika Captcha terlalu sulit</span>
                    <div class="input-wrapper">
                        <?xml version="1.0" encoding="utf-8"?><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 116.79" style="enable-background:new 0 0 122.88 116.79" xml:space="preserve"><style type="text/css"><![CDATA[
                                .st0{fill:#ABABAB;}
                                .st1{fill:#1C3AA9;}
                                .st2{fill:#A6A6A6;}
                                .st3{fill:#4285F4;}
                            ]]></style><g><path class="st1" d="M101.42,40.78c0-0.59-0.02-1.17-0.04-1.75V5.88l-9.16,9.17C84.72,5.86,73.31,0,60.53,0 c-13.3,0-25.12,6.35-32.59,16.18l15.02,15.18c1.47-2.72,3.56-5.06,6.08-6.83c2.62-2.05,6.34-3.72,11.48-3.72 c0.62,0,1.1,0.07,1.45,0.21c6.37,0.5,11.89,4.02,15.14,9.12L66.48,40.77C79.95,40.72,95.17,40.69,101.42,40.78L101.42,40.78 L101.42,40.78z M101.42,40.78L101.42,40.78L101.42,40.78L101.42,40.78z"/><path class="st3" d="M60.29,0c-0.59,0-1.17,0.02-1.75,0.04H25.38l9.17,9.16C25.37,16.71,19.5,28.12,19.5,40.9 c0,13.3,6.35,25.12,16.18,32.59l15.18-15.02c-2.72-1.47-5.06-3.56-6.83-6.08c-2.05-2.62-3.72-6.34-3.72-11.48 c0-0.62,0.07-1.1,0.21-1.45c0.5-6.37,4.02-11.89,9.12-15.14l10.63,10.63C60.23,21.47,60.19,6.26,60.29,0L60.29,0L60.29,0z M60.29,0 L60.29,0L60.29,0L60.29,0z"/><path class="st0" d="M19.51,40.9c0,0.59,0.02,1.17,0.04,1.75V75.8l9.16-9.16c7.5,9.18,18.91,15.04,31.69,15.04 c13.3,0,25.12-6.35,32.59-16.18L77.97,50.32c-1.47,2.72-3.56,5.06-6.08,6.83c-2.62,2.05-6.34,3.72-11.48,3.72 c-0.62,0-1.1-0.07-1.45-0.21c-6.37-0.5-11.89-4.02-15.14-9.12l10.63-10.63C40.98,40.96,25.76,40.99,19.51,40.9L19.51,40.9 L19.51,40.9z M19.51,40.9L19.51,40.9L19.51,40.9L19.51,40.9z"/><path class="st2" d="M26.41,97.52c-1,0-1.89,0.19-2.68,0.57c-0.79,0.37-1.46,0.9-2.01,1.58c-0.54,0.69-0.96,1.52-1.25,2.5 c-0.28,0.97-0.42,2.06-0.42,3.26v3.46c0,1.21,0.14,2.3,0.42,3.27c0.29,0.97,0.7,1.8,1.24,2.49c0.53,0.69,1.18,1.21,1.93,1.58 c0.76,0.37,1.61,0.55,2.55,0.55c0.97,0,1.82-0.14,2.55-0.42c0.74-0.28,1.36-0.69,1.85-1.22c0.5-0.54,0.88-1.19,1.15-1.96 c0.27-0.76,0.44-1.63,0.49-2.6l-2.38,0c-0.06,0.75-0.16,1.39-0.31,1.92c-0.15,0.52-0.36,0.96-0.64,1.3 c-0.27,0.34-0.64,0.58-1.08,0.75c-0.44,0.15-0.98,0.23-1.62,0.23c-0.69,0-1.27-0.15-1.75-0.45c-0.48-0.31-0.87-0.73-1.17-1.26 c-0.29-0.53-0.51-1.16-0.64-1.87c-0.13-0.71-0.19-1.48-0.19-2.31v-3.49c0-0.88,0.08-1.69,0.23-2.41c0.16-0.72,0.41-1.33,0.73-1.84 c0.33-0.51,0.74-0.9,1.24-1.17c0.5-0.28,1.09-0.42,1.78-0.42c0.58,0,1.07,0.09,1.48,0.26c0.41,0.16,0.76,0.42,1.03,0.77 c0.27,0.34,0.48,0.78,0.63,1.31c0.15,0.53,0.24,1.17,0.3,1.91h2.38c-0.04-1.01-0.2-1.91-0.48-2.69c-0.27-0.78-0.66-1.44-1.15-1.97 c-0.49-0.53-1.09-0.94-1.79-1.21C28.12,97.66,27.32,97.52,26.41,97.52L26.41,97.52L26.41,97.52z M84.58,97.52 c-1,0-1.89,0.19-2.68,0.57c-0.79,0.37-1.46,0.9-2.01,1.58c-0.54,0.69-0.96,1.52-1.25,2.5c-0.28,0.97-0.42,2.06-0.42,3.26v3.46 c0,1.21,0.14,2.3,0.42,3.27c0.29,0.97,0.71,1.8,1.24,2.49c0.53,0.69,1.18,1.21,1.93,1.58c0.76,0.37,1.61,0.55,2.55,0.55 c0.97,0,1.82-0.14,2.55-0.42c0.74-0.28,1.36-0.69,1.86-1.22c0.5-0.54,0.88-1.19,1.15-1.96c0.27-0.76,0.44-1.63,0.49-2.6l-2.38,0 c-0.06,0.75-0.16,1.39-0.31,1.92c-0.15,0.52-0.36,0.96-0.64,1.3c-0.28,0.34-0.63,0.58-1.08,0.75c-0.44,0.15-0.98,0.23-1.62,0.23 c-0.69,0-1.27-0.15-1.75-0.45c-0.48-0.31-0.87-0.73-1.17-1.26c-0.29-0.53-0.51-1.16-0.64-1.87c-0.13-0.71-0.19-1.48-0.19-2.31 v-3.49c0-0.88,0.08-1.69,0.23-2.41c0.16-0.72,0.41-1.33,0.73-1.84s0.74-0.9,1.24-1.17c0.5-0.28,1.09-0.42,1.78-0.42 c0.58,0,1.07,0.09,1.48,0.26c0.41,0.16,0.76,0.42,1.03,0.77c0.28,0.34,0.49,0.78,0.63,1.31c0.14,0.53,0.24,1.17,0.29,1.91h2.38 c-0.04-1.01-0.2-1.91-0.48-2.69c-0.28-0.78-0.66-1.44-1.15-1.97c-0.49-0.53-1.09-0.94-1.79-1.21 C86.29,97.66,85.49,97.52,84.58,97.52L84.58,97.52L84.58,97.52z M39.98,97.78l-6.04,18.76h2.42l1.46-4.89h6.34l1.48,4.89h2.42 l-6.05-18.76H39.98L39.98,97.78z M50.61,97.78v18.76h2.36v-7.34h3.62c0.9,0,1.7-0.13,2.4-0.37c0.7-0.26,1.28-0.63,1.75-1.11 c0.48-0.48,0.84-1.07,1.08-1.78c0.25-0.71,0.37-1.52,0.37-2.42c0-0.83-0.13-1.6-0.37-2.29c-0.24-0.7-0.6-1.31-1.07-1.82 c-0.47-0.51-1.06-0.91-1.77-1.2c-0.7-0.28-1.49-0.43-2.4-0.43L50.61,97.78L50.61,97.78z M64,97.78v2.04h4.92v16.72h2.36V99.81h4.93 v-2.04H64L64,97.78z M93.59,97.78v18.76h2.36v-8.67h7.55v8.67h2.37V97.78h-2.37v8.06h-7.55v-8.06H93.59L93.59,97.78z M114.8,97.78 l-6.04,18.76h2.42l1.46-4.89h6.34l1.48,4.89h2.42l-6.05-18.76H114.8L114.8,97.78z M52.97,99.81h3.62c0.58,0,1.06,0.1,1.47,0.31 c0.41,0.21,0.75,0.48,1,0.82c0.27,0.34,0.46,0.74,0.58,1.2c0.13,0.45,0.19,0.91,0.19,1.39c0,0.53-0.06,1.02-0.19,1.47 c-0.12,0.44-0.31,0.82-0.58,1.15c-0.26,0.32-0.59,0.57-1,0.75c-0.4,0.18-0.89,0.27-1.47,0.27h-3.62V99.81L52.97,99.81z M40.99,101.08l2.56,8.53h-5.11L40.99,101.08L40.99,101.08z M115.81,101.08l2.56,8.53h-5.12L115.81,101.08L115.81,101.08z M4.84,102.34c-0.59,0-1.1,0.15-1.53,0.45c-0.42,0.3-0.77,0.71-1.06,1.22l-0.04-1.42H0v13.94h2.28v-9.97 c0.21-0.59,0.52-1.06,0.91-1.4c0.4-0.34,0.91-0.52,1.53-0.52c0.2,0,0.37,0.01,0.53,0.03c0.15,0.01,0.32,0.03,0.5,0.06l-0.01-2.22 c-0.03-0.02-0.09-0.03-0.17-0.05c-0.07-0.03-0.15-0.05-0.23-0.06s-0.18-0.03-0.27-0.04C4.99,102.35,4.91,102.34,4.84,102.34 L4.84,102.34L4.84,102.34z M12.51,102.34c-0.66,0-1.3,0.12-1.92,0.35c-0.62,0.23-1.17,0.61-1.65,1.15 c-0.47,0.52-0.85,1.21-1.15,2.06c-0.29,0.84-0.44,1.88-0.44,3.1v1.57c0,1.06,0.12,1.99,0.37,2.77c0.25,0.78,0.61,1.43,1.07,1.95 c0.47,0.51,1.04,0.88,1.71,1.13c0.67,0.25,1.42,0.37,2.25,0.37c0.6,0,1.14-0.06,1.61-0.18c0.48-0.12,0.91-0.28,1.28-0.46 c0.37-0.2,0.69-0.42,0.95-0.67c0.27-0.25,0.49-0.51,0.68-0.77l-1.19-1.44c-0.19,0.23-0.39,0.45-0.61,0.64 c-0.21,0.19-0.45,0.36-0.71,0.5c-0.26,0.14-0.54,0.25-0.85,0.32c-0.31,0.08-0.66,0.12-1.04,0.12c-1.06,0-1.87-0.34-2.43-1.02 c-0.56-0.68-0.84-1.76-0.84-3.26v-0.32l7.78,0v-1.33c0-1.06-0.09-2-0.27-2.82c-0.18-0.82-0.47-1.5-0.86-2.06 c-0.4-0.56-0.9-0.98-1.52-1.26C14.13,102.48,13.38,102.34,12.51,102.34L12.51,102.34z M12.51,104.3c0.5,0,0.91,0.09,1.24,0.27 s0.58,0.43,0.77,0.76c0.2,0.33,0.34,0.72,0.42,1.17c0.09,0.45,0.15,0.94,0.18,1.48v0.31H9.64c0.03-0.78,0.13-1.43,0.28-1.95 c0.15-0.51,0.36-0.92,0.61-1.22c0.26-0.31,0.55-0.52,0.89-0.64C11.75,104.36,12.11,104.3,12.51,104.3L12.51,104.3L12.51,104.3z"/></g>
                        </svg>
                        <input class="form-control" type="text" name="captcha" id="captcha" required placeholder="Masukkan CAPTCHA">
                    </div>
                    
                </div>

                @if(session('status'))
                    @if(is_array(session('status')))
                        @if(array_key_exists('status', session('status')) && array_key_exists('message', session('status')) )
                            @if(session('status')['status'] !== null)
                                <div class="alert alert-{{ session('status')['status'] }} solid alert-dismissible fade show" style="color:red">
                                    *
                                    {{ session('status')['message'] }}
                                </div>
                            @endif
                        @endif
                    @endif
                @endif

                <div class="row">
                    
                </div>

                <div id="btn-submit">
                    <button class="btn" type="button" onclick="submitform(this)" >Masuk ke Akun</button>
                </div>
            </form>

            {{-- <div class="divider"><span>atau</span></div>

            <p class="footer">
                Belum punya akun? <a class="link" href="#">Daftar sekarang</a>
            </p> --}}
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        // document.getElementById('btn-refresh').addEventListener('click', async () => {
        //   const res = await fetch("{{ route('captcha.refresh') }}", { cache: "no-store" });
        //   const data = await res.json();
        //   document.getElementById('captcha-img').src = data.url; // URL pasti beda karena ada &_=timestamp
        // });
        var i = 0;
        function submitform(button){
            var form = document.getElementById('login-form');
            if (!form.checkValidity()) {
                form.reportValidity(); // munculkan pesan required
                return; // STOP submit
            }

            button.disabled = true; // disable tombol untuk mencegah multiple submit
            button.innerText = 'Memproses...'; // ubah teks tombol untuk feedback
            i++;
            if(i > 1){
                return;
            }
            form.submit();
        }

        function reloadCaptcha(){
            console.log('reload');
            $.ajax({
                type: 'GET',
                url: '/reload-captcha',
                success: function(data) {
                    $('#captcha-image').attr('src', data.url);
        // console.log(data);
                }
            });
        }
    </script>
</body>
</html>