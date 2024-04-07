<?php

namespace App\Providers;

use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use App\Respositories\Repositories\UsuarioRepository;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Services\Services\UsuarioServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InterfaceUsuarioRepository::class, UsuarioRepository::class);
        $this->app->bind(InterfaceUsuarioServices::class, UsuarioServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
 
        //
    }
}
