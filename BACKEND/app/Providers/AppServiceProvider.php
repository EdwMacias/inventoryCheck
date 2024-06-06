<?php

namespace App\Providers;

use App\Repositories\Interfaces\InterfaceDocumentTypeRepository;
use App\Repositories\Interfaces\InterfaceGenderRepository;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Repositories\Interfaces\InterfaceRolesUsuarioRepository;
use App\Repositories\Interfaces\InterfaceTemporaryCode;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Repositories\Repositories\GenderRepository;
use App\Repositories\Repositories\ItemObservationRepository;
use App\Repositories\Repositories\ItemRepository;
use App\Repositories\Repositories\ResourceRepository;
use App\Repositories\Repositories\RolesUserRepository;
use App\Repositories\Repositories\TemporaryCodeRepository;
use App\Repositories\Repositories\TypeDocumentRepository;
use App\Repositories\Repositories\UsuarioRepository;
use App\Services\Interfaces\InterfaceItemObservationServices;
use App\Services\Interfaces\InterfaceItemServices;
use App\Services\Interfaces\InterfaceTemporaryCodeServices;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Services\Services\ItemObservationServices;
use App\Services\Services\ItemServices;
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
        $this->app->bind(InterfaceItemRepository::class, ItemRepository::class);
        $this->app->bind(InterfaceResourceRepository::class, ResourceRepository::class);
        $this->app->bind(InterfaceItemObservationRepository::class, ItemObservationRepository::class);
        // Services
        $this->app->bind(InterfaceUsuarioServices::class, UsuarioServices::class);
        $this->app->bind(InterfaceTemporaryCodeServices::class, TemporaryCodeServices::class);
        $this->app->bind(InterfaceItemServices::class, ItemServices::class);
        $this->app->bind(InterfaceItemObservationServices::class, ItemObservationServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //
    }
}
