{{-- Page Picker: auto-fill URL dari halaman statis --}}
@if(isset($pages) && $pages->count() > 0)
<div class="form-group">
    <label class="form-label">
        <i class="fas fa-file-alt me-1" style="color:var(--primary)"></i>
        Pilih dari Halaman Statis
        <span style="font-weight:400;color:#94a3b8;font-size:12px">(opsional — otomatis mengisi URL)</span>
    </label>
    <select id="pagePicker" class="form-select"
            onchange="applyPageToMenu(this)">
        <option value="">— Pilih halaman statis —</option>
        @foreach($pages as $p)
        <option value="/halaman/{{ $p->slug }}"
                data-title="{{ $p->title }}"
                data-slug="{{ $p->slug }}">
            {{ $p->title }}
            <small>({{ $p->slug }})</small>
        </option>
        @endforeach
    </select>
    <div class="form-hint">
        Pilih halaman untuk mengisi kolom URL secara otomatis.
        URL akan mengarah ke <code>/halaman/{slug}</code>.
    </div>
</div>

<div style="border-left:3px solid var(--border);padding-left:14px;margin-bottom:20px">
    <div style="font-size:12px;color:#94a3b8;margin-bottom:6px">
        <i class="fas fa-info-circle me-1"></i>Daftar halaman yang tersedia:
    </div>
    <div class="d-flex flex-wrap gap-2">
        @foreach($pages as $p)
        <button type="button"
                class="btn btn-sm btn-secondary"
                style="font-size:11px;padding:4px 10px"
                onclick="quickPickPage('/halaman/{{ $p->slug }}', '{{ addslashes($p->title) }}')">
            <i class="fas fa-file me-1"></i>{{ $p->title }}
        </button>
        @endforeach
    </div>
</div>
@endif
