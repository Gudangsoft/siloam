<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class ProfilKontenController extends Controller
{
    public function editVisiMisi()
    {
        $page = Page::findOrCreateBySlug('visi-misi', 'Visi & Misi');

        $visi = $page->meta_title ?: '';

        $misiDefault = [
            'Menyelenggarakan pendidikan dan pengajaran yang handal di bidang teologi dan pendidikan agama Kristen.',
            'Menyelenggarakan penelitian teologi dan pendidikan agama Kristen yang handal dalam konteks Pendidikan Agama Kristen dan penggembalaan jemaat.',
            'Menyelenggarakan pengabdian masyarakat yang handal dalam bidang pelayanan gereja dan sekolah.',
            'Menyelenggarakan pendidikan agama Kristen dan penggembalaan jemaat dengan semangat oikumenis.',
        ];

        $misi = $misiDefault;
        if ($page->content) {
            $decoded = json_decode($page->content, true);
            if (is_array($decoded)) {
                $misi = array_pad($decoded, 4, '');
            }
        }

        return view('admin.profil.visi-misi', compact('page', 'visi', 'misi'));
    }

    public function updateVisiMisi(Request $request)
    {
        $request->validate([
            'visi'     => 'required|string|max:500',
            'misi'     => 'required|array|size:4',
            'misi.*'   => 'required|string|max:500',
        ], [
            'visi.required'  => 'Teks Visi wajib diisi.',
            'misi.*.required'=> 'Semua item Misi wajib diisi.',
        ]);

        $page = Page::findOrCreateBySlug('visi-misi', 'Visi & Misi');
        $page->update([
            'meta_title' => $request->visi,
            'content'    => json_encode(array_values($request->misi), JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('admin.profil.visi-misi.edit')
            ->with('success', 'Visi & Misi berhasil disimpan!');
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
}
