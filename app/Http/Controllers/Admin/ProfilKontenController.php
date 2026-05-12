<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class ProfilKontenController extends Controller
{
    private array $misiDefault = [
        'Menyelenggarakan pendidikan dan pengajaran yang handal di bidang teologi dan pendidikan agama Kristen.',
        'Menyelenggarakan penelitian teologi dan pendidikan agama Kristen yang handal dalam konteks Pendidikan Agama Kristen dan penggembalaan jemaat.',
        'Menyelenggarakan pengabdian masyarakat yang handal dalam bidang pelayanan gereja dan sekolah.',
        'Menyelenggarakan pendidikan agama Kristen dan penggembalaan jemaat dengan semangat oikumenis.',
    ];

    private array $tujuanDefault = [
        'Menghasilkan lulusan Guru Agama Kristen yang profesional dan kompeten di bidangnya.',
        'Menghasilkan hamba Tuhan yang mampu memimpin dan menggembalakan jemaat secara efektif.',
        'Menghasilkan peneliti di bidang teologi dan pendidikan agama Kristen yang berkontribusi bagi pengembangan gereja.',
        'Menghasilkan tenaga pengabdi masyarakat yang handal dalam pelayanan gereja, sekolah, dan komunitas.',
        'Membentuk karakter Kristen yang kuat sebagai fondasi pelayanan di gereja dan masyarakat.',
    ];

    private function decodeContent(?string $content): array
    {
        if (!$content) return ['misi' => [], 'tujuan' => []];

        $decoded = json_decode($content, true);
        if (!is_array($decoded)) return ['misi' => [], 'tujuan' => []];

        // Format lama: plain array (hanya misi)
        if (isset($decoded[0])) {
            return ['misi' => $decoded, 'tujuan' => []];
        }

        return [
            'misi'   => $decoded['misi']   ?? [],
            'tujuan' => $decoded['tujuan'] ?? [],
        ];
    }

    public function editVisiMisi()
    {
        $page = Page::findOrCreateBySlug('visi-misi', 'Visi & Misi');
        $visi = $page->meta_title ?: '';

        $data   = $this->decodeContent($page->content);
        $misi   = !empty($data['misi'])   ? $data['misi']   : $this->misiDefault;
        $tujuan = !empty($data['tujuan']) ? $data['tujuan'] : $this->tujuanDefault;

        return view('admin.profil.visi-misi', compact('page', 'visi', 'misi', 'tujuan'));
    }

    public function updateVisiMisi(Request $request)
    {
        $request->validate([
            'visi'      => 'required|string|max:500',
            'misi'      => 'required|array|min:1',
            'misi.*'    => 'required|string|max:500',
            'tujuan'    => 'required|array|min:1',
            'tujuan.*'  => 'required|string|max:500',
        ], [
            'visi.required'    => 'Teks Visi wajib diisi.',
            'misi.required'    => 'Minimal 1 item Misi.',
            'misi.*.required'  => 'Item Misi tidak boleh kosong.',
            'tujuan.required'  => 'Minimal 1 item Tujuan.',
            'tujuan.*.required'=> 'Item Tujuan tidak boleh kosong.',
        ]);

        $page = Page::findOrCreateBySlug('visi-misi', 'Visi & Misi');
        $page->update([
            'meta_title' => $request->visi,
            'content'    => json_encode([
                'misi'   => array_values($request->misi),
                'tujuan' => array_values($request->tujuan),
            ], JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('admin.profil.visi-misi.edit')
            ->with('success', 'Visi, Misi & Tujuan berhasil disimpan!');
    }

    public function editSejarah()
    {
        $page = Page::findOrCreateBySlug('sejarah', 'Sejarah STT Siloam');
        return view('admin.profil.sejarah', compact('page'));
    }

    public function updateSejarah(Request $request)
    {
        $request->validate(['content' => 'nullable|string']);
        $page = Page::findOrCreateBySlug('sejarah', 'Sejarah STT Siloam');
        $page->update(['content' => $request->content]);
        return redirect()->route('admin.profil.sejarah.edit')
            ->with('success', 'Konten Sejarah berhasil disimpan!');
    }

    public function getMisiDefault(): array   { return $this->misiDefault; }
    public function getTujuanDefault(): array { return $this->tujuanDefault; }
}
