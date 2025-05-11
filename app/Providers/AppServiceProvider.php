<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->registerViteHotReload();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(8)
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->mixedCase();
        });
    }

    /**
     * Enable Vite hot reload for development.
     */
    private function registerViteHotReload(): void
    {
        if (Vite::isRunningHot()) {
            FilamentView::registerRenderHook(
                'panels::head.start',
                fn (): string => Vite::toHtml()
            );
        }
    }
}
