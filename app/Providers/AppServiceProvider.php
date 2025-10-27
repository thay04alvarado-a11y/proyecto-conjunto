<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Compartir configuración del sitio con todas las vistas
        View::composer('*', function ($view) {
            try {
                $configuracion = \App\Models\ConfiguracionSitio::where('activo', 1)->first();
                $view->with('configuracionSitio', $configuracion);
            } catch (\Exception $e) {
                $view->with('configuracionSitio', null);
            }
        });
    }
}
