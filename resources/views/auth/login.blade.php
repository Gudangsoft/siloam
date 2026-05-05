<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — STT Siloam Medan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
            overflow: hidden;
        }
        /* Left Panel */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #2563eb 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            top: -150px; left: -150px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -100px; right: -100px;
        }
        .brand {
            text-align: center;
            z-index: 1;
            position: relative;
        }
        .brand-icon {
            width: 90px; height: 90px;
            background: rgba(255,255,255,0.15);
            border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .brand-icon i { font-size: 40px; color: white; }
        .brand h1 {
            font-size: 28px; font-weight: 700;
            color: white; margin-bottom: 8px;
            line-height: 1.3;
        }
        .brand p {
            color: rgba(255,255,255,0.75);
            font-size: 15px; line-height: 1.6;
            max-width: 320px;
        }
        .features {
            margin-top: 48px; z-index: 1; position: relative;
            width: 100%; max-width: 340px;
        }
        .feature-item {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 18px;
            background: rgba(255,255,255,0.08);
            border-radius: 12px;
            margin-bottom: 12px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .feature-item i {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.15);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #93c5fd; flex-shrink: 0;
        }
        .feature-item span { color: rgba(255,255,255,0.85); font-size: 14px; }
        .bottom-text {
            position: absolute; bottom: 30px;
            color: rgba(255,255,255,0.4); font-size: 13px;
            z-index: 1;
        }
        /* Right Panel */
        .right-panel {
            width: 480px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 56px;
        }
        .login-header { margin-bottom: 36px; }
        .login-header h2 {
            font-size: 26px; font-weight: 700;
            color: #0f172a; margin-bottom: 8px;
        }
        .login-header p { color: #64748b; font-size: 15px; }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; font-size: 14px; font-weight: 500;
            color: #374151; margin-bottom: 8px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap i {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; font-size: 16px;
        }
        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            color: #0f172a;
            transition: all 0.2s;
            outline: none;
            background: #f8fafc;
        }
        .input-wrap input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }
        .input-wrap .toggle-pw {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; cursor: pointer; font-size: 16px;
            left: auto;
        }
        .error-msg {
            color: #ef4444; font-size: 13px; margin-top: 6px;
            display: flex; align-items: center; gap: 5px;
        }
        .remember-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .remember-row label {
            display: flex; align-items: center; gap: 8px;
            font-size: 14px; color: #374151; cursor: pointer;
        }
        .remember-row input[type="checkbox"] {
            width: 16px; height: 16px; accent-color: #2563eb;
        }
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #1e40af, #2563eb);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px; font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            letter-spacing: 0.3px;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #1d3a9e, #1d4ed8);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.3);
        }
        .btn-login:active { transform: translateY(0); }
        .divider {
            text-align: center; margin: 24px 0;
            position: relative;
        }
        .divider::before {
            content: '';
            position: absolute; top: 50%; left: 0; right: 0;
            height: 1px; background: #e2e8f0;
        }
        .divider span {
            background: white; padding: 0 12px;
            color: #94a3b8; font-size: 13px;
            position: relative;
        }
        .back-link {
            display: flex; align-items: center; justify-content: center;
            gap: 8px; color: #64748b; font-size: 14px;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .back-link:hover { color: #2563eb; background: #eff6ff; }
        .alert-error {
            background: #fef2f2; border: 1px solid #fecaca;
            border-radius: 10px; padding: 14px 16px;
            color: #dc2626; font-size: 14px;
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 10px; padding: 14px 16px;
            color: #16a34a; font-size: 14px;
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 32px; }
        }
    </style>
</head>
<body>
    <!-- Left Panel -->
    <div class="left-panel">
        <div class="brand">
            <div class="brand-icon">
                <i class="fas fa-cross"></i>
            </div>
            <h1>STT Siloam Medan</h1>
            <p>Panel Administrasi Website Resmi Sekolah Tinggi Teologi Siloam Medan</p>
        </div>
        <div class="features">
            <div class="feature-item">
                <i class="fas fa-newspaper"></i>
                <span>Kelola Berita & Konten Website</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-users-cog"></i>
                <span>Manajemen Data Mahasiswa & Alumni</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-clipboard-list"></i>
                <span>Monitor Pendaftaran Mahasiswa Baru</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-chart-bar"></i>
                <span>Dashboard Statistik & Laporan</span>
            </div>
        </div>
        <span class="bottom-text">© {{ date('Y') }} STT Siloam Medan</span>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="login-header">
            <h2>Selamat Datang Kembali 👋</h2>
            <p>Masuk ke panel administrasi STT Siloam Medan</p>
        </div>

        @if(session('status'))
        <div class="alert-success">
            <i class="fas fa-check-circle mt-0.5"></i>
            <span>{{ session('status') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="alert-error">
            <i class="fas fa-exclamation-circle mt-0.5"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="admin@sttsiloam.ac.id"
                           required autofocus autocomplete="username">
                </div>
                @error('email')
                <div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           required autocomplete="current-password">
                    <i class="fas fa-eye toggle-pw" onclick="togglePassword()" id="eyeIcon"></i>
                </div>
                @error('password')
                <div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:14px;color:#2563eb;text-decoration:none;">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Masuk ke Admin Panel
            </button>
        </form>

        <div class="divider"><span>atau</span></div>

        <a href="{{ url('/') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Website
        </a>
    </div>

    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (pw.type === 'password') {
                pw.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pw.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
