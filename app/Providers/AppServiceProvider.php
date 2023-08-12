<?php

namespace App\Providers;
use App\Observers\TagObserver;

use App\Models\Tag;
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
    public function boot()
    {
        // Registrar el observador para el modelo Tag
        Tag::observe(TagObserver::class);
    }
}
