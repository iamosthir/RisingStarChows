<?php

namespace App\Providers;

use App\Models\ApplicationMessage;
use App\Observers\ApplicationMessageObserver;
use App\View\Composers\SettingsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ApplicationMessage::observe(ApplicationMessageObserver::class);

        // Share website settings with all views using View::share
        View::share('settings', \App\Models\WebsiteSetting::first() ?? new \App\Models\WebsiteSetting());

        // Share SEO settings with all views
        View::share('seo', \App\Models\SeoSetting::getSeoSettings());
    }
}
