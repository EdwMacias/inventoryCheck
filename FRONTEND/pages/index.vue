<template>
    <div class="breadcrumbs text-lg">
        <ul>
            <li>
                <a>Inicio</a>
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-8 p-4">
        <div>
            <NuxtLink :to="INDEX_PAGE_INVENTARIO"
                class="card bg-base-100 image-full w-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
                <figure class="h-64">
                    <img src="/images/inventarioWorkSpace.webp" alt="Inventario" class="object-cover w-full h-full" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Inventario!</h2>
                    <p>Chequea todo lo relacionado con inventario</p>
                </div>
            </NuxtLink>
        </div>

        <div v-if="userRole === 'SUPERADMINISTRADOR'">
            <NuxtLink :to="INDEX_USUARIOS"
                class="card bg-base-100 image-full w-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
                <figure class="h-64">
                    <img src="/images/UsuarioWorkSpace.webp" alt="Usuarios" class="object-cover w-full h-full" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Usuarios!</h2>
                    <p>Gestiona y asigna roles a tus usuarios</p>
                </div>
            </NuxtLink>
        </div>

        <div>
            <!-- @click="pushPath(INDEX_PAGE_TERCERO)" -->
            <NuxtLink :to="INDEX_PAGE_TERCERO"
                class="card bg-base-100 image-full w-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
                <figure class="h-64">
                    <img src="/images/tercerosWorkSpace.webp" alt="Terceros" class="object-cover w-full h-full" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">TERCEROS!</h2>
                    <p>Consulta de terceros</p>
                </div>
            </NuxtLink>
        </div>
    </div>
</template>
<style scoped></style>

<script setup lang="ts">
import { INDEX_PAGE_INVENTARIO, INDEX_PAGE_TERCERO, INDEX_USUARIOS } from '~/Infrastructure/Paths/Paths';
import { UsuarioStore } from '~/stores/UsuarioStore';
const usuarioStore = UsuarioStore();
const userRole = usuarioStore.userRole;
</script>