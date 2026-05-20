<?php

namespace App\View\Composers;

use App\Models\WebsiteSetting;
use Illuminate\View\View;

class SettingsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('settings', WebsiteSetting::getSettings());
    }
}
