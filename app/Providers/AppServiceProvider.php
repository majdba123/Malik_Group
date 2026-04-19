<?php

namespace App\Providers;

use App\Models\SiteFooterSetting;
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
        View::composer('layouts.storefront', function ($view): void {
            try {
                $footerSetting = SiteFooterSetting::query()->first();
            } catch (\Throwable) {
                $footerSetting = null;
            }
            $view->with('footerSetting', $footerSetting);
        });
    }
}
