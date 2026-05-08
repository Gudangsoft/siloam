<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Pesan Baru</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',Arial,sans-serif;background:#f1f5f9;color:#334155}
.wrap{max-width:600px;margin:32px auto;background:white;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
.header{background:linear-gradient(135deg,#1e3a8a,#2563eb);padding:32px 36px;color:white}
.header h1{font-size:22px;font-weight:700;margin-bottom:4px}
.header p{font-size:13px;opacity:.8}
.body{padding:32px 36px}
.badge{display:inline-block;background:#eff6ff;color:#1d4ed8;border-radius:20px;padding:4px 12px;font-size:12px;font-weight:600;margin-bottom:20px}
.field{margin-bottom:18px}
.field label{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;margin-bottom:4px}
.field .val{font-size:15px;color:#1e293b;font-weight:500}
.message-box{background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:16px;margin-top:6px;font-size:14px;line-height:1.7;color:#475569;white-space:pre-line}
.divider{border:none;border-top:1px solid #f1f5f9;margin:24px 0}
.footer{background:#f8fafc;padding:20px 36px;font-size:12px;color:#94a3b8;text-align:center;border-top:1px solid #f1f5f9}
.footer strong{color:#64748b}
.btn{display:inline-block;background:#1d4ed8;color:white;text-decoration:none;padding:10px 24px;border-radius:8px;font-size:13px;font-weight:600;margin-top:16px}
</style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <h1>📬 Pesan Baru dari Website</h1>
        <p>STT Siloam Medan — Formulir Kontak</p>
    </div>
    <div class="body">
        <span class="badge">{{ now()->format('d M Y, H:i') }} WIB</span>

        <div class="field">
            <label>Nama Pengirim</label>
            <div class="val">{{ $contact->name }}</div>
        </div>

        <div class="field">
            <label>Email</label>
            <div class="val"><a href="mailto:{{ $contact->email }}" style="color:#2563eb">{{ $contact->email }}</a></div>
        </div>

        @if($contact->phone)
        <div class="field">
            <label>Nomor Telepon</label>
            <div class="val">{{ $contact->phone }}</div>
        </div>
        @endif

        <div class="field">
            <label>Subjek</label>
            <div class="val">{{ $contact->subject }}</div>
        </div>

        <div class="field">
            <label>Isi Pesan</label>
            <div class="message-box">{{ $contact->message }}</div>
        </div>

        <hr class="divider">

        <p style="font-size:13px;color:#64748b;line-height:1.6">
            Untuk membalas, klik reply ke email pengirim atau buka panel admin.
        </p>
        <a href="{{ config('app.url') }}/admin/contacts" class="btn">Buka Panel Admin</a>
    </div>
    <div class="footer">
        <strong>STT Siloam Medan</strong> &bull; Email otomatis dari sistem website<br>
        Jangan balas email ini secara langsung.
    </div>
</div>
</body>
</html>
