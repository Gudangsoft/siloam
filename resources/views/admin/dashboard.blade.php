@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Selamat datang, ' . auth()->user()->name)
@section('content')

{{-- ===== WELCOME BANNER ===== --}}
<div style="background:linear-gradient(135deg,#1e3a8a 0%,#2563eb 100%);border-radius:16px;padding:20px 24px;margin-bottom:24px;display:flex;align-items:center;gap:16px;flex-wrap:wrap">
    <div style="flex:1;min-width:180px">
        <div style="color:rgba(255,255,255,.6);font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.8px;margin-bottom:3px">Selamat datang kembali</div>
        <div style="color:white;font-size:20px;font-weight:800;line-height:1.2">{{ auth()->user()->name }}</div>
        <div style="color:rgba(255,255,255,.45);font-size:12px;margin-top:3px">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</div>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
        @php $btnBase = 'display:inline-flex;align-items:center;gap:7px;padding:9px 16px;border-radius:10px;color:white;text-decoration:none;font-size:13px;font-weight:600;transition:all .15s'; @endphp
        <a href="{{ route('admin.news.create') }}"
           style="{{ $btnBase }};background:rgba(255,255,255,.15)"
           onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
            <i class="fas fa-plus-circle"></i> Tulis Berita
        </a>
        <a href="{{ route('admin.events.create') }}"
           style="{{ $btnBase }};background:rgba(255,255,255,.15)"
           onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
            <i class="fas fa-calendar-plus"></i> Buat Agenda
        </a>
        <a href="{{ route('admin.gallery.create') }}"
           style="{{ $btnBase }};background:rgba(255,255,255,.15)"
           onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
            <i class="fas fa-images"></i> Upload Foto
        </a>
        @if($stats['pmb_pending'] > 0)
        <a href="{{ route('admin.pmb.index') }}"
           style="{{ $btnBase }};background:rgba(239,68,68,.75)"
           onmouseover="this.style.background='rgba(220,38,38,.9)'" onmouseout="this.style.background='rgba(239,68,68,.75)'">
            <i class="fas fa-user-clock"></i> {{ $stats['pmb_pending'] }} Menunggu Review
        </a>
        @endif
        @if($stats['contacts'] > 0)
        <a href="{{ route('admin.contacts.index') }}"
           style="{{ $btnBase }};background:rgba(245,158,11,.75)"
           onmouseover="this.style.background='rgba(217,119,6,.9)'" onmouseout="this.style.background='rgba(245,158,11,.75)'">
            <i class="fas fa-envelope"></i> {{ $stats['contacts'] }} Pesan Baru
        </a>
        @endif
        <a href="{{ url('/') }}" target="_blank"
           style="{{ $btnBase }};background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.75)"
           onmouseover="this.style.background='rgba(255,255,255,.15)'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
            <i class="fas fa-external-link-alt"></i> Lihat Website
        </a>
    </div>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background:#eff6ff;color:#2563eb;"><i class="fas fa-user-plus"></i></div>
        <div><div class="stat-value">{{ number_format($stats['pmb_total']) }}</div><div class="stat-label">Total Pendaftar PMB</div></div>
        <div class="stat-trend"><span style="color:#64748b;font-size:12px;">{{ $stats['pmb_pending'] }} menunggu review</span></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;"><i class="fas fa-check-circle"></i></div>
        <div><div class="stat-value">{{ $stats['pmb_accepted'] }}</div><div class="stat-label">Pendaftar Diterima</div></div>
        <div class="stat-trend"><a href="{{ route('admin.pmb.index') }}" style="color:#2563eb;font-size:12px;">Lihat PMB &rarr;</a></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fefce8;color:#d97706;"><i class="fas fa-envelope"></i></div>
        <div><div class="stat-value">{{ $stats['contacts'] }}</div><div class="stat-label">Pesan Belum Dibaca</div></div>
        <div class="stat-trend"><a href="{{ route('admin.contacts.index') }}" style="color:#2563eb;font-size:12px;">Lihat pesan &rarr;</a></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fdf4ff;color:#9333ea;"><i class="fas fa-newspaper"></i></div>
        <div><div class="stat-value">{{ $stats['news'] }}</div><div class="stat-label">Total Berita</div></div>
        <div class="stat-trend"><a href="{{ route('admin.news.index') }}" style="color:#2563eb;font-size:12px;">Kelola berita &rarr;</a></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fff7ed;color:#ea580c;"><i class="fas fa-user-tie"></i></div>
        <div><div class="stat-value">{{ $stats['staff'] }}</div><div class="stat-label">Dosen & Staf Aktif</div></div>
        <div class="stat-trend"><span style="color:#64748b;font-size:12px;">{{ $stats['study_programs'] }} program studi</span></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#ecfdf5;color:#059669;"><i class="fas fa-user-graduate"></i></div>
        <div><div class="stat-value">{{ number_format($stats['alumni']) }}</div><div class="stat-label">Data Alumni</div></div>
        <div class="stat-trend"><a href="{{ route('admin.alumni.index') }}" style="color:#2563eb;font-size:12px;">Kelola alumni &rarr;</a></div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 360px;gap:24px;margin-bottom:24px;">
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-user-plus" style="color:#2563eb;margin-right:8px;"></i>Pendaftaran PMB Terbaru</h4>
            <a href="{{ route('admin.pmb.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrapper">
            <table style="width:100%;border-collapse:collapse;">
                <thead><tr>
                    <th style="padding:10px 16px;background:#f8fafc;font-size:12px;color:#64748b;font-weight:600;text-align:left;border-bottom:1px solid #e2e8f0;">Nama</th>
                    <th style="padding:10px 16px;background:#f8fafc;font-size:12px;color:#64748b;font-weight:600;text-align:left;border-bottom:1px solid #e2e8f0;">Program Studi</th>
                    <th style="padding:10px 16px;background:#f8fafc;font-size:12px;color:#64748b;font-weight:600;text-align:left;border-bottom:1px solid #e2e8f0;">Tanggal</th>
                    <th style="padding:10px 16px;background:#f8fafc;font-size:12px;color:#64748b;font-weight:600;text-align:left;border-bottom:1px solid #e2e8f0;">Status</th>
                    <th style="padding:10px 16px;background:#f8fafc;font-size:12px;color:#64748b;font-weight:600;text-align:left;border-bottom:1px solid #e2e8f0;"></th>
                </tr></thead>
                <tbody>
                @forelse($latest_pmb as $pmb)
                @php $sc=['pending'=>'warning','review'=>'info','accepted'=>'success','rejected'=>'danger'];$sl=['pending'=>'Pending','review'=>'Review','accepted'=>'Diterima','rejected'=>'Ditolak']; @endphp
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:12px 16px;"><div style="font-size:14px;font-weight:600;color:#1e293b;">{{ $pmb->full_name }}</div><div style="font-size:12px;color:#94a3b8;">{{ $pmb->registration_number ?? '-' }}</div></td>
                    <td style="padding:12px 16px;font-size:13px;color:#374151;">{{ Str::limit($pmb->study_program, 22) }}</td>
                    <td style="padding:12px 16px;font-size:13px;color:#94a3b8;">{{ $pmb->created_at->format('d M Y') }}</td>
                    <td style="padding:12px 16px;"><span class="badge-status badge-{{ $sc[$pmb->status] ?? 'secondary' }}">{{ $sl[$pmb->status] ?? $pmb->status }}</span></td>
                    <td style="padding:12px 16px;"><a href="{{ route('admin.pmb.show', $pmb) }}" class="btn btn-secondary btn-sm btn-icon"><i class="fas fa-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding:32px;text-align:center;color:#94a3b8;">Belum ada pendaftaran</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-envelope" style="color:#d97706;margin-right:8px;"></i>Pesan Terbaru</h4>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div style="padding:8px 0;">
        @forelse($unread_contacts as $msg)
            <a href="{{ route('admin.contacts.show', $msg) }}" style="display:flex;align-items:flex-start;gap:12px;padding:12px 20px;text-decoration:none;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                <div style="width:36px;height:36px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#2563eb;"><i class="fas fa-user"></i></div>
                <div style="flex:1;min-width:0;"><div style="font-size:13.5px;font-weight:600;color:#1e293b;">{{ $msg->name }}</div><div style="font-size:12px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $msg->subject }}</div><div style="font-size:11px;color:#94a3b8;margin-top:2px;">{{ $msg->created_at->diffForHumans() }}</div></div>
                <div style="width:8px;height:8px;background:#ef4444;border-radius:50%;margin-top:6px;flex-shrink:0;"></div>
            </a>
        @empty
            <div style="padding:40px;text-align:center;color:#94a3b8;"><i class="fas fa-check-circle" style="font-size:36px;color:#10b981;margin-bottom:10px;display:block;"></i>Semua pesan sudah dibaca</div>
        @endforelse
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px;">
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-newspaper" style="color:#9333ea;margin-right:8px;"></i>Berita Terbaru</h4>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tulis</a>
        </div>
        <div style="padding:8px 0;">
        @forelse($latest_news as $news)
            <div style="display:flex;align-items:center;gap:12px;padding:10px 20px;border-bottom:1px solid #f1f5f9;">
                <div style="width:38px;height:38px;background:#f3e8ff;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#9333ea;"><i class="fas fa-file-alt"></i></div>
                <div style="flex:1;min-width:0;"><a href="{{ route('admin.news.edit', $news) }}" style="font-size:13.5px;font-weight:600;color:#1e293b;text-decoration:none;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $news->title }}</a><div style="font-size:12px;color:#94a3b8;margin-top:2px;">{{ $news->published_at ? $news->published_at->format('d M Y') : 'Draft' }}</div></div>
                <span class="badge-status {{ $news->is_published ? 'badge-success' : 'badge-secondary' }}" style="font-size:11px;">{{ $news->is_published ? 'Publish' : 'Draft' }}</span>
            </div>
        @empty
            <div style="padding:32px;text-align:center;color:#94a3b8;">Belum ada berita</div>
        @endforelse
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-calendar-alt" style="color:#16a34a;margin-right:8px;"></i>Agenda Mendatang</h4>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Buat</a>
        </div>
        <div style="padding:8px 0;">
        @forelse($upcoming_events as $event)
            <div style="display:flex;align-items:flex-start;gap:12px;padding:10px 20px;border-bottom:1px solid #f1f5f9;">
                <div style="text-align:center;background:#eff6ff;border-radius:10px;padding:6px 10px;min-width:44px;flex-shrink:0;"><div style="font-size:18px;font-weight:800;color:#1e40af;line-height:1;">{{ $event->start_date->format('d') }}</div><div style="font-size:10px;font-weight:600;color:#64748b;text-transform:uppercase;">{{ $event->start_date->format('M') }}</div></div>
                <div style="flex:1;min-width:0;"><div style="font-size:13.5px;font-weight:600;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $event->title }}</div><div style="font-size:12px;color:#94a3b8;margin-top:2px;"><i class="fas fa-map-marker-alt"></i> {{ $event->location ?? 'TBA' }}</div></div>
            </div>
        @empty
            <div style="padding:40px;text-align:center;color:#94a3b8;"><i class="fas fa-calendar-times" style="font-size:36px;margin-bottom:10px;display:block;"></i>Tidak ada agenda mendatang</div>
        @endforelse
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;">
    <div class="card">
        <div class="card-header"><h4><i class="fas fa-chart-bar" style="color:#2563eb;margin-right:8px;"></i>Distribusi PMB per Program Studi</h4></div>
        <div class="card-body">
        @forelse($pmb_by_program as $item)
            @php $pct = $stats['pmb_total'] > 0 ? round(($item->total/$stats['pmb_total'])*100) : 0; @endphp
            <div style="margin-bottom:16px;">
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;"><span style="font-size:13.5px;font-weight:600;color:#1e293b;">{{ $item->study_program }}</span><span style="font-size:13px;color:#64748b;">{{ $item->total }} ({{ $pct }}%)</span></div>
                <div style="height:8px;background:#f1f5f9;border-radius:4px;"><div style="height:100%;background:linear-gradient(90deg,#1e40af,#3b82f6);border-radius:4px;width:{{ $pct }}%;"></div></div>
            </div>
        @empty
            <div style="text-align:center;color:#94a3b8;padding:24px;">Belum ada data pendaftaran</div>
        @endforelse
        @if($stats['pmb_total'] > 0)
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:20px;padding-top:20px;border-top:1px solid #f1f5f9;">
            @foreach(['pending' => ['#fff7ed','#ea580c','Pending'], 'review' => ['#eff6ff','#2563eb','Review'], 'accepted' => ['#f0fdf4','#16a34a','Diterima'], 'rejected' => ['#fef2f2','#dc2626','Ditolak']] as $s => $c)
            <div style="text-align:center;background:{{ $c[0] }};border-radius:12px;padding:14px 8px;"><div style="font-size:22px;font-weight:800;color:{{ $c[1] }};">{{ $pmb_by_status[$s]->total ?? 0 }}</div><div style="font-size:11px;color:#64748b;font-weight:600;margin-top:4px;">{{ $c[2] }}</div></div>
            @endforeach
        </div>
        @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h4><i class="fas fa-bolt" style="color:#d97706;margin-right:8px;"></i>Aksi Cepat</h4></div>
        <div style="padding:16px;display:grid;grid-template-columns:1fr 1fr;gap:10px;">
        @php
        $actions=[
            ['admin.news.create','fa-newspaper','Tulis Berita','#eff6ff','#2563eb'],
            ['admin.events.create','fa-calendar-plus','Buat Agenda','#f0fdf4','#16a34a'],
            ['admin.gallery.create','fa-images','Upload Foto','#fdf4ff','#9333ea'],
            ['admin.staff.create','fa-user-plus','Tambah Staf','#fff7ed','#ea580c'],
            ['admin.research.create','fa-flask','Penelitian','#ecfdf5','#059669'],
            ['admin.alumni.create','fa-user-graduate','Alumni Baru','#fefce8','#d97706'],
            ['admin.partnerships.create','fa-handshake','Kerjasama','#eff6ff','#0284c7'],
            ['admin.settings.index','fa-cog','Pengaturan','#f1f5f9','#475569'],
        ];
        @endphp
        @foreach($actions as $a)
            <a href="{{ route($a[0]) }}" style="display:flex;flex-direction:column;align-items:center;gap:8px;padding:14px 8px;background:{{ $a[3] }};border-radius:12px;text-decoration:none;transition:transform 0.15s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                <i class="fas {{ $a[1] }}" style="font-size:20px;color:{{ $a[4] }};"></i>
                <span style="font-size:11.5px;font-weight:600;color:{{ $a[4] }};text-align:center;line-height:1.2;">{{ $a[2] }}</span>
            </a>
        @endforeach
        </div>
        <div style="margin:0 16px 16px;padding:16px;background:linear-gradient(135deg,#1e3a8a,#2563eb);border-radius:12px;text-align:center;">
            <div style="color:rgba(255,255,255,0.7);font-size:11px;margin-bottom:8px;">Website Publik</div>
            <a href="{{ url('/') }}" target="_blank" style="color:white;font-size:13px;font-weight:600;text-decoration:none;"><i class="fas fa-external-link-alt"></i> Buka Website</a>
        </div>
    </div>
</div>
@endsection