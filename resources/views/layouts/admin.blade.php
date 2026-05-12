<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Admin {{ $siteSettings->get('app_name', 'STT Siloam Medan') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
    <!-- Favicon -->
    @if($siteSettings->get('favicon'))
    <link rel="icon" href="{{ Storage::disk('public')->url($siteSettings->get('favicon')) }}">
    @endif

    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --primary-dark: #1e3a8a;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #1e40af;
            --sidebar-width: 260px;
            --topbar-height: 64px;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --bg-page: #f1f5f9;
            --card-bg: #ffffff;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:var(--bg-page); color:#1e293b; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed; left:0; top:0; bottom:0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            display: flex; align-items: center; gap: 12px;
        }
        .brand-logo {
            width: 42px; height: 42px;
            background: var(--primary);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .brand-logo i { color: white; font-size: 18px; }
        .brand-text h3 {
            color: white; font-size: 14px; font-weight: 700;
            line-height: 1.2;
        }
        .brand-text span { color: var(--text-muted); font-size: 11px; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 12px 0; }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }
        .nav-section {
            padding: 16px 16px 6px;
        }
        .nav-section-label {
            font-size: 10px; font-weight: 600; letter-spacing: 1.2px;
            color: rgba(255,255,255,0.3); text-transform: uppercase;
        }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 16px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            border-radius: 8px;
            margin: 2px 8px;
            font-size: 13.5px; font-weight: 500;
            transition: all 0.15s;
            position: relative;
        }
        .nav-item:hover {
            background: var(--sidebar-hover);
            color: white;
        }
        .nav-item.active {
            background: var(--sidebar-active);
            color: white;
        }
        .nav-item .icon {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px;
            flex-shrink: 0;
            font-size: 14px;
        }
        .nav-item.active .icon { background: rgba(255,255,255,0.2); }
        .nav-item:hover:not(.active) .icon { background: rgba(255,255,255,0.08); }
        .nav-badge {
            margin-left: auto;
            background: var(--danger);
            color: white; font-size: 10px; font-weight: 700;
            padding: 2px 7px; border-radius: 20px;
        }
        /* Sub-menu */
        .nav-group summary {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 16px;
            color: rgba(255,255,255,0.65);
            border-radius: 8px;
            margin: 2px 8px;
            font-size: 13.5px; font-weight: 500;
            cursor: pointer;
            list-style: none;
            transition: all 0.15s;
        }
        .nav-group summary::-webkit-details-marker { display: none; }
        .nav-group summary:hover { background: var(--sidebar-hover); color: white; }
        .nav-group[open] summary { color: white; background: rgba(255,255,255,0.06); }
        .nav-group .icon {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; flex-shrink: 0; font-size: 14px;
        }
        .nav-group summary .chevron {
            margin-left: auto;
            font-size: 11px;
            transition: transform 0.2s;
        }
        .nav-group[open] summary .chevron { transform: rotate(180deg); }
        .nav-sub {
            padding: 4px 0;
        }
        .nav-sub .nav-item {
            padding: 8px 16px 8px 58px;
            font-size: 13px;
            color: rgba(255,255,255,0.5);
        }
        .nav-sub .nav-item.active { color: white; background: rgba(37,99,235,0.3); }
        /* User footer */
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .user-card {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px;
            background: rgba(255,255,255,0.06);
            border-radius: 10px;
        }
        .user-avatar {
            width: 36px; height: 36px;
            background: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 15px;
            flex-shrink: 0;
        }
        .user-info { flex: 1; min-width: 0; }
        .user-info .name {
            color: white; font-size: 13px; font-weight: 600;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .user-info .role { color: var(--text-muted); font-size: 11px; }
        .logout-btn {
            color: var(--text-muted); font-size: 16px;
            cursor: pointer; transition: color 0.15s;
            text-decoration: none;
        }
        .logout-btn:hover { color: var(--danger); }

        /* ===== TOPBAR ===== */
        .topbar {
            position: fixed; top:0;
            left: var(--sidebar-width); right: 0;
            height: var(--topbar-height);
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 24px;
            z-index: 50;
            gap: 16px;
        }
        .topbar-toggle {
            display: none;
            background: none; border: none;
            font-size: 20px; color: #64748b;
            cursor: pointer; padding: 4px;
        }
        .page-title {
            flex: 1;
        }
        .page-title h2 {
            font-size: 18px; font-weight: 700; color: #0f172a;
            line-height: 1;
        }
        .page-title .breadcrumb {
            font-size: 12px; color: #94a3b8; margin-top: 3px;
        }
        .topbar-actions {
            display: flex; align-items: center; gap: 12px;
        }
        .topbar-btn {
            width: 38px; height: 38px;
            background: var(--bg-page);
            border: none; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #64748b; cursor: pointer;
            font-size: 16px; transition: all 0.15s;
            text-decoration: none; position: relative;
        }
        .topbar-btn:hover { background: var(--border); color: var(--primary); }
        .topbar-btn .badge {
            position: absolute; top: -3px; right: -3px;
            background: var(--danger); color: white;
            font-size: 9px; font-weight: 700;
            width: 16px; height: 16px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .topbar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 12px;
            background: var(--bg-page);
            border-radius: 10px; cursor: pointer;
            border: none; font-family: 'Inter', sans-serif;
        }
        .topbar-user span { font-size: 13px; font-weight: 600; color: #374151; }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 28px;
            min-height: calc(100vh - var(--topbar-height));
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
        }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h4 {
            font-size: 15px; font-weight: 700; color: #0f172a;
        }
        .card-body { padding: 24px; }

        /* ===== STAT CARDS ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 22px;
            border: 1px solid var(--border);
            display: flex; flex-direction: column; gap: 12px;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.07);
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }
        .stat-value {
            font-size: 30px; font-weight: 800; color: #0f172a;
            line-height: 1;
        }
        .stat-label { font-size: 13px; color: #64748b; font-weight: 500; }
        .stat-trend {
            font-size: 12px; display: flex; align-items: center; gap: 4px;
        }
        .trend-up { color: var(--success); }
        .trend-down { color: var(--danger); }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px;
            border-radius: 8px; border: none;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: all 0.15s; font-family: 'Inter', sans-serif;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-success:hover { background: #059669; color: white; }
        .btn-warning { background: var(--warning); color: white; }
        .btn-warning:hover { background: #d97706; color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-danger:hover { background: #dc2626; color: white; }
        .btn-secondary { background: var(--bg-page); color: #374151; border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--border); color: #0f172a; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .btn-icon { width: 34px; height: 34px; padding: 0; justify-content: center; }

        /* ===== FORMS ===== */
        .form-label { font-size: 13.5px; font-weight: 600; color: #374151; margin-bottom: 7px; display: block; }
        .form-control, .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 14px; color: #1e293b;
            background: #f8fafc;
            transition: all 0.2s;
            outline: none;
            font-family: 'Inter', sans-serif;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            background: white;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        .form-check { display: flex; align-items: center; gap: 8px; }
        .form-check input { width: 16px; height: 16px; accent-color: var(--primary); cursor: pointer; }
        .form-check label { font-size: 14px; color: #374151; cursor: pointer; margin: 0; }
        .form-group { margin-bottom: 20px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-hint { font-size: 12px; color: #94a3b8; margin-top: 5px; }

        /* ===== ALERTS ===== */
        .alert {
            padding: 14px 18px; border-radius: 10px;
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 20px; font-size: 14px;
        }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .alert-danger { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
        .alert-warning { background: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
        .alert-info { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }

        /* ===== TABLES ===== */
        .table-wrapper { overflow-x: auto; }
        table.dataTable { width: 100% !important; border-collapse: collapse; }
        table.dataTable thead th {
            background: var(--bg-page);
            color: #475569; font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
            padding: 12px 16px;
            border-bottom: 2px solid var(--border);
        }
        table.dataTable tbody td {
            padding: 14px 16px; font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            color: #374151;
        }
        table.dataTable tbody tr:hover td { background: #f8fafc; }
        .badge-status {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-secondary { background: #f1f5f9; color: #475569; }

        /* ===== OVERLAY ===== */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.5); z-index: 99;
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .main-content { margin-left: 0; }
            .topbar { left: 0; }
            .topbar-toggle { display: flex; }
        }
        @media (max-width: 640px) {
            .main-content { padding: 16px; }
            .form-row { grid-template-columns: 1fr; }
            .stat-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            @if($siteSettings->get('logo'))
                <img src="{{ Storage::disk('public')->url($siteSettings->get('logo')) }}"
                     style="height:36px;max-width:140px;object-fit:contain;flex-shrink:0"
                     alt="{{ $siteSettings->get('app_name','STT Siloam') }}">
            @else
                <div class="brand-logo"><i class="fas fa-cross"></i></div>
            @endif
            <div class="brand-text">
                <h3>{{ $siteSettings->get('app_name', 'STT Siloam') }}</h3>
                <span>Admin Panel</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <!-- Dashboard -->
            <div class="nav-section">
                <div class="nav-section-label">Utama</div>
            </div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-th-large"></i></span>
                Dashboard
            </a>

            <!-- Konten Website -->
            <div class="nav-section">
                <div class="nav-section-label">Konten Website</div>
            </div>
            <a href="{{ route('admin.hero-banners.index') }}"
               class="nav-item {{ request()->routeIs('admin.hero-banners.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-image"></i></span>
                Banner Beranda
            </a>
            <a href="{{ route('admin.news.index') }}"
               class="nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-newspaper"></i></span>
                Berita & Artikel
            </a>
            <a href="{{ route('admin.events.index') }}"
               class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                Agenda & Kegiatan
            </a>
            <a href="{{ route('admin.gallery.index') }}"
               class="nav-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-images"></i></span>
                Galeri Foto
            </a>
            <a href="{{ route('admin.videos.index') }}"
               class="nav-item {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                <span class="icon"><i class="fab fa-youtube"></i></span>
                Video
            </a>
            <a href="{{ route('admin.pages.index') }}"
               class="nav-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-file-alt"></i></span>
                Halaman Statis
            </a>
            <a href="{{ route('admin.menus.index') }}"
               class="nav-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-bars"></i></span>
                Menu Dinamis
            </a>

            <!-- Profil Kampus -->
            <div class="nav-section">
                <div class="nav-section-label">Profil Kampus</div>
            </div>
            <a href="{{ route('admin.staff.index') }}"
               class="nav-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-user-tie"></i></span>
                Dosen & Staf
            </a>
            <a href="{{ route('admin.study-programs.index') }}"
               class="nav-item {{ request()->routeIs('admin.study-programs.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                Program Studi
            </a>
            <a href="{{ route('admin.facilities.index') }}"
               class="nav-item {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-building"></i></span>
                Fasilitas
            </a>
            <a href="{{ route('admin.academic-calendars.index') }}"
               class="nav-item {{ request()->routeIs('admin.academic-calendars.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                Kalender Akademik
            </a>

            <!-- PMB & Mahasiswa -->
            <div class="nav-section">
                <div class="nav-section-label">PMB & Mahasiswa</div>
            </div>
            <a href="{{ route('admin.pmb-info.index') }}"
               class="nav-item {{ request()->routeIs('admin.pmb-info.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-info-circle"></i></span>
                Info PMB
            </a>
            <a href="{{ route('admin.pmb.index') }}"
               class="nav-item {{ request()->routeIs('admin.pmb.*') && !request()->routeIs('admin.pmb-info.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-user-plus"></i></span>
                Pendaftaran PMB
                @php $pendingPmb = \App\Models\PmbRegistration::where('status','pending')->count(); @endphp
                @if($pendingPmb > 0)
                <span class="nav-badge">{{ $pendingPmb }}</span>
                @endif
            </a>
            <a href="{{ route('admin.scholarships.index') }}"
               class="nav-item {{ request()->routeIs('admin.scholarships.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-award"></i></span>
                Beasiswa
            </a>
            <a href="{{ route('admin.student-organizations.index') }}"
               class="nav-item {{ request()->routeIs('admin.student-organizations.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-users"></i></span>
                Organisasi Mahasiswa
            </a>
            <a href="{{ route('admin.student-achievements.index') }}"
               class="nav-item {{ request()->routeIs('admin.student-achievements.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-trophy"></i></span>
                Prestasi Mahasiswa
            </a>
            <a href="{{ route('admin.alumni.index') }}"
               class="nav-item {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-user-graduate"></i></span>
                Data Alumni
            </a>

            <!-- Penelitian & Kerjasama -->
            <div class="nav-section">
                <div class="nav-section-label">Penelitian & Kerjasama</div>
            </div>
            <a href="{{ route('admin.research.index') }}"
               class="nav-item {{ request()->routeIs('admin.research.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-flask"></i></span>
                Penelitian & Pengabdian
            </a>
            <a href="{{ route('admin.partnerships.index') }}"
               class="nav-item {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-handshake"></i></span>
                Kerjasama
            </a>

            <!-- Lainnya -->
            <div class="nav-section">
                <div class="nav-section-label">Lainnya</div>
            </div>
            <a href="{{ route('admin.contacts.index') }}"
               class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-envelope"></i></span>
                Pesan Masuk
                @php $unreadMsg = \App\Models\Contact::where('is_read', false)->count(); @endphp
                @if($unreadMsg > 0)
                <span class="nav-badge">{{ $unreadMsg }}</span>
                @endif
            </a>
            <a href="{{ route('admin.settings.index') }}"
               class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-cog"></i></span>
                Pengaturan Website
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">Administrator</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn" title="Keluar">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ===== TOPBAR ===== -->
    <header class="topbar">
        <button class="topbar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="page-title">
            <h2>@yield('page-title', 'Dashboard')</h2>
            <div class="breadcrumb">@yield('breadcrumb', 'Admin Panel')</div>
        </div>
        <div class="topbar-actions">
            <a href="{{ url('/') }}" target="_blank" class="topbar-btn" title="Lihat Website">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="topbar-btn" title="Pesan Masuk">
                <i class="fas fa-envelope"></i>
                @if(($unreadMsg ?? 0) > 0)
                <span class="badge">{{ $unreadMsg }}</span>
                @endif
            </a>
            <button class="topbar-user">
                <div style="width:30px;height:30px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <span>{{ auth()->user()->name }}</span>
                <i class="fas fa-chevron-down" style="font-size:10px;color:#94a3b8;"></i>
            </button>
        </div>
    </header>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
        }
        // DataTables default init
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.datatable')) {
                $('.datatable').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                        emptyTable: 'Tidak ada data tersedia',
                        zeroRecords: 'Data tidak ditemukan',
                        info: 'Menampilkan _START_-_END_ dari _TOTAL_ data',
                        infoEmpty: 'Menampilkan 0-0 dari 0 data',
                        search: 'Cari:',
                        lengthMenu: 'Tampilkan _MENU_ data',
                        paginate: { next: 'Selanjutnya', previous: 'Sebelumnya' }
                    },
                    pageLength: 15,
                    responsive: true,
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
