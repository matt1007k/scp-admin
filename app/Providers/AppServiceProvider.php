<?php

namespace App\Providers;

use App\Services\MenuService;
use Illuminate\Support\Facades\Vite;
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
        $menus = MenuService::getMenus();

        view()->composer('layouts.side-menu', fn($view) => $view->with('menus', $menus));
        Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));
    }
}
