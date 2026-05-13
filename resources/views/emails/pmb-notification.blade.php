<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Pendaftar PMB Baru</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',Arial,sans-serif;background:#f1f5f9;color:#334155}
.wrap{max-width:600px;margin:32px auto;background:white;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
.header{background:linear-gradient(135deg,#065f46,#059669);padding:32px 36px;color:white}
.header h1{font-size:22px;font-weight:700;margin-bottom:4px}
.header p{font-size:13px;opacity:.8}
.body{padding:32px 36px}
.badge{display:inline-block;background:#ecfdf5;color:#065f46;border-radius:20px;padding:4px 12px;font-size:12px;font-weight:600;margin-bottom:20px}
.reg-number{background:#f0fdf4;border:2px solid #86efac;border-radius:8px;padding:12px 16px;margin-bottom:20px;font-size:18px;font-weight:700;color:#065f46;text-align:center;letter-spacing:1px}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:0}
.field{padding:10px 0;border-bottom:1px solid #f1f5f9}
.field.full{grid-column:1/-1}
.field label{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;margin-bottom:3px}
.field .val{font-size:14px;color:#1e293b;font-weight:500}
.section-title{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#059669;margin:20px 0 10px;padding-top:16px;border-top:2px solid #f0fdf4}
.message-box{background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:14px;font-size:13px;line-height:1.7;color:#475569;white-space:pre-line}
.divider{border:none;border-top:1px solid #f1f5f9;margin:20px 0}
.footer{background:#f8fafc;padding:20px 36px;font-size:12px;color:#94a3b8;text-align:center;border-top:1px solid #f1f5f9}
.footer strong{color:#64748b}
.btn{display:inline-block;background:#059669;color:white;text-decoration:none;padding:10px 24px;border-radius:8px;font-size:13px;font-weight:600;margin-top:16px}
</style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <h1>🎓 Pendaftar PMB Baru</h1>
        <p>{{ $siteSettings->get('app_name') }} — Penerimaan Mahasiswa Baru</p>
    </div>
    <div class="body">
        <span class="badge">{{ now()->format('d M Y, H:i') }} WIB</span>
        <div class="reg-number">{{ $registration->registration_number }}</div>

        <div class="section-title">Data Pribadi</div>
        <div class="grid">
            <div class="field full">
                <label>Nama Lengkap</label>
                <div class="val">{{ $registration->full_name }}</div>
            </div>
            <div class="field">
                <label>Jenis Kelamin</label>
                <div class="val">{{ $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>
            <div class="field">
                <label>Tempat, Tanggal Lahir</label>
                <div class="val">{{ $registration->birth_place ? $registration->birth_place . ', ' : '' }}{{ $registration->birth_date?->format('d M Y') ?? '-' }}</div>
            </div>
            @if($registration->email)
            <div class="field">
                <label>Email</label>
                <div class="val"><a href="mailto:{{ $registration->email }}" style="color:#059669">{{ $registration->email }}</a></div>
            </div>
            @endif
            <div class="field">
                <label>Telepon / WhatsApp</label>
                <div class="val">{{ $registration->phone }}</div>
            </div>
        </div>

        <div class="section-title">Data Pendaftaran</div>
        <div class="grid">
            <div class="field full">
                <label>Program Studi yang Dipilih</label>
                <div class="val" style="color:#059669;font-size:15px">{{ $registration->study_program }}</div>
            </div>
            <div class="field">
                <label>Asal Sekolah</label>
                <div class="val">{{ $registration->high_school_name }}</div>
            </div>
            <div class="field">
                <label>Tahun Lulus</label>
                <div class="val">{{ $registration->graduation_year }}</div>
            </div>
            @if($registration->registration_path)
            <div class="field">
                <label>Jalur Pendaftaran</label>
                <div class="val">{{ $registration->registration_path }}</div>
            </div>
            @endif
        </div>

        @if($registration->parent_name)
        <div class="section-title">Data Orang Tua</div>
        <div class="grid">
            <div class="field">
                <label>Nama Orang Tua</label>
                <div class="val">{{ $registration->parent_name }}</div>
            </div>
            <div class="field">
                <label>Telepon Orang Tua</label>
                <div class="val">{{ $registration->parent_phone ?? '-' }}</div>
            </div>
        </div>
        @endif

        <hr class="divider">
        <p style="font-size:13px;color:#64748b;line-height:1.6">
            Segera tinjau data pendaftar di panel admin untuk memproses lebih lanjut.
        </p>
        <a href="{{ config('app.url') }}/admin/pmb" class="btn">Lihat Data Pendaftar</a>
    </div>
    <div class="footer">
        <strong>{{ $siteSettings->get('app_name') }}</strong> &bull; Email otomatis dari sistem PMB<br>
        Jangan balas email ini secara langsung.
    </div>
</div>
</body>
</html>
