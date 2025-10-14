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
        // Partager les variables globales avec toutes les vues
        view()->composer('*', function ($view) {
            $view->with('whatsappNumber', config('services.whatsapp.number'));
            $view->with('emailjsConfig', [
                'publicKey' => config('services.emailjs.public_key'),
                'serviceId' => config('services.emailjs.service_id'),
                'templateId' => config('services.emailjs.template_id'),
            ]);
        });
    }
}
