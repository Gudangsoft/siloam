<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingsComposer
{
    public function compose(View $view): void
    {
        try {
            $settings = Setting::all()->pluck('value', 'key');
        } catch (\Exception $e) {
            $settings = collect();
        }

        $view->with('siteSettings', $settings);
    }
}
