<?php

namespace App\Providers;

use App\Respositories\Interfaces\InterfaceDocumentTypeRepository;
use App\Respositories\Interfaces\InterfaceGenderRepository;
use App\Respositories\Interfaces\InterfaceRolesUsuarioRepository;
use App\Respositories\Interfaces\InterfaceTemporaryCode;
use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use App\Respositories\Repositories\GenderRepository;
use App\Respositories\Repositories\RolesUserRepository;
use App\Respositories\Repositories\TemporaryCodeRepository;
use App\Respositories\Repositories\TypeDocumentRepository;
use App\Respositories\Repositories\UsuarioRepository;
use App\Services\Interfaces\InterfaceTemporaryCodeServices;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Services\Services\TemporaryCodeServices;
use App\Services\Services\UsuarioServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(InterfaceUsuarioRepository::class, UsuarioRepository::class);
        $this->app->bind(InterfaceDocumentTypeRepository::class, TypeDocumentRepository::class);
        $this->app->bind(InterfaceGenderRepository::class, GenderRepository::class);
        $this->app->bind(InterfaceRolesUsuarioRepository::class, RolesUserRepository::class);
        $this->app->bind(InterfaceTemporaryCode::class, TemporaryCodeRepository::class);
        
        // Services
        $this->app->bind(InterfaceUsuarioServices::class, UsuarioServices::class);
        $this->app->bind(InterfaceTemporaryCodeServices::class, TemporaryCodeServices::class);
        

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
 
        //
    }
}
