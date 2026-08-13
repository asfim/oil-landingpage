<?php

namespace App\Providers;

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
        // Auto-clear frontend cache when admin makes any updates
        $clearCache = function () {
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
        };

        if (class_exists(\App\Models\Product::class)) {
            \App\Models\Product::saved($clearCache);
            \App\Models\Product::deleted($clearCache);
        }
        
        if (class_exists(\App\Models\Setting::class)) {
            \App\Models\Setting::saved($clearCache);
            \App\Models\Setting::deleted($clearCache);
        }

        if (class_exists(\App\Models\SalesPopup::class)) {
            \App\Models\SalesPopup::saved($clearCache);
            \App\Models\SalesPopup::deleted($clearCache);
        }

        if (class_exists(\App\Models\WhyChooseItem::class)) {
            \App\Models\WhyChooseItem::saved($clearCache);
            \App\Models\WhyChooseItem::deleted($clearCache);
        }

        if (class_exists(\App\Models\Benefit::class)) {
            \App\Models\Benefit::saved($clearCache);
            \App\Models\Benefit::deleted($clearCache);
        }
    }
}
