<?php

namespace App\Providers;

use App\Repositories\Interfaces\InterfaceDocumentTypeRepository;
use App\Repositories\Interfaces\InterfaceEquipoRespository;
use App\Repositories\Interfaces\InterfaceGenderRepository;
use App\Repositories\Interfaces\InterfaceItemBasicoRepository;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Repositories\Interfaces\InterfaceRolesUserRepository;
use App\Repositories\Interfaces\InterfaceTemporaryCode;
use App\Repositories\Interfaces\InterfaceTypesObservationRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Repositories\Repositories\EquipoRespository;
use App\Repositories\Repositories\GenderRepository;
use App\Repositories\Repositories\ItemBasicoRepository;
use App\Repositories\Repositories\ItemObservationRepository;
use App\Repositories\Repositories\ItemRepository;
use App\Repositories\Repositories\ResourceRepository;
use App\Repositories\Repositories\RolesUserRepository;
use App\Repositories\Repositories\TemporaryCodeRepository;
use App\Repositories\Repositories\TypeDocumentRepository;
use App\Repositories\Repositories\TypesObservationRepository;
use App\Repositories\Repositories\UsuarioRepository;
use App\Services\Interfaces\InterfaceItemObservationServices;
use App\Services\Interfaces\InterfaceItemServices;
use App\Services\Interfaces\InterfaceRolesServices;
use App\Services\Interfaces\InterfaceTemporaryCodeServices;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Services\Services\ItemObservationServices;
use App\Services\Services\ItemServices;
use App\Services\Services\RolesServices;
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
        $this->app->bind(InterfaceRolesUserRepository::class, RolesUserRepository::class);
        $this->app->bind(InterfaceTemporaryCode::class, TemporaryCodeRepository::class);
        $this->app->bind(InterfaceItemRepository::class, ItemRepository::class);
        $this->app->bind(InterfaceResourceRepository::class, ResourceRepository::class);
        $this->app->bind(InterfaceItemObservationRepository::class, ItemObservationRepository::class);
        $this->app->bind(InterfaceTypesObservationRepository::class, TypesObservationRepository::class);
        $this->app->bind(InterfaceEquipoRespository::class, EquipoRespository::class);
        $this->app->bind(InterfaceItemBasicoRepository::class, ItemBasicoRepository::class);

        // Services
        $this->app->bind(InterfaceUsuarioServices::class, UsuarioServices::class);
        $this->app->bind(InterfaceTemporaryCodeServices::class, TemporaryCodeServices::class);
        $this->app->bind(InterfaceItemServices::class, ItemServices::class);
        $this->app->bind(InterfaceItemObservationServices::class, ItemObservationServices::class);
        $this->app->bind(InterfaceRolesServices::class, RolesServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //
    }
}
