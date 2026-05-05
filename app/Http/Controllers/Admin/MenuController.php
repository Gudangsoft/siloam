<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('childrenAll')
                     ->topLevel()
                     ->orderBy('location')
                     ->orderBy('order')
                     ->get();

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::topLevel()->active()->orderBy('order')->get();
        $pages   = Page::orderBy('title')->get(['id', 'title', 'slug']);
        return view('admin.menus.create', compact('parents', 'pages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:100',
            'url'       => 'nullable|string|max:500',
            'icon'      => 'nullable|string|max:100',
            'parent_id' => 'nullable|exists:menus,id',
            'order'     => 'required|integer|min:0',
            'target'    => 'required|in:_self,_blank',
            'location'  => 'required|in:main,footer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        Menu::create($data);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::topLevel()
                       ->where('id', '!=', $menu->id)
                       ->orderBy('order')
                       ->get();
        $pages = Page::orderBy('title')->get(['id', 'title', 'slug']);

        return view('admin.menus.edit', compact('menu', 'parents', 'pages'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:100',
            'url'       => 'nullable|string|max:500',
            'icon'      => 'nullable|string|max:100',
            'parent_id' => 'nullable|exists:menus,id',
            'order'     => 'required|integer|min:0',
            'target'    => 'required|in:_self,_blank',
            'location'  => 'required|in:main,footer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        // Cegah set parent ke dirinya sendiri
        if (isset($data['parent_id']) && $data['parent_id'] == $menu->id) {
            $data['parent_id'] = null;
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete(); // cascade ke children
        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil dihapus.');
    }

    /** Toggle aktif/nonaktif via AJAX */
    public function toggle(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);
        return response()->json(['is_active' => $menu->is_active]);
    }

    /** Update urutan via drag-and-drop (AJAX) */
    public function reorder(Request $request)
    {
        $items = $request->validate(['items' => 'required|array'])['items'];

        foreach ($items as $item) {
            Menu::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
