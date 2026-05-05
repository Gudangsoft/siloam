<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use App\Models\Menu;
use Illuminate\View\View;

class SettingsComposer
{
    public function compose(View $view): void
    {
        // Site Settings
        try {
            $settings = Setting::all()->pluck('value', 'key');
        } catch (\Exception $e) {
            $settings = collect();
        }

        // Menu Dinamis
        try {
            $navMenus = Menu::with('children')
                ->topLevel()
                ->active()
                ->location('main')
                ->orderBy('order')
                ->get();

            $footerMenus = Menu::topLevel()
                ->active()
                ->location('footer')
                ->orderBy('order')
                ->get();
        } catch (\Exception $e) {
            $navMenus    = collect();
            $footerMenus = collect();
        }

        $view->with('siteSettings',  $settings);
        $view->with('navMenus',      $navMenus);
        $view->with('footerMenus',   $footerMenus);
    }
}

