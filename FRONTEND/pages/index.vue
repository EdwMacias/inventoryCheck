<template>
    <div class="breadcrumbs text-lg">
        <ul>
            <li>
                <a >Inicio</a>
            </li>
        </ul>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-10">

        <div @click="pushPath('/inventario/')"
            class="card bg-base-100 image-full w-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
            <figure>
                <img src="/images/inventarioWorkSpace.webp" alt="inventario" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Inventario!</h2>
                <p>Chequea todo lo relacionado con inventario</p>
            </div>
        </div>

        <div v-if="userRole === 'SUPERADMINISTRADOR'" @click="pushPath('/usuarios/')"
            class="card bg-base-100 image-full w-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
            <figure>
                <img src="/images/UsuarioWorkSpace.webp" alt="inventario" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Usuarios!</h2>
                <p>Gestiona y asigna roles a tus usuarios</p>
            </div>
        </div>

        <div @click="pushPath('/terceros/')"
            class="card bg-base-100 image-full w-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
            <figure>
                <img src="/images/tercerosWorkSpace.webp" alt="inventario" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">TERCEROS!</h2>
                <p>Consulta de terceros</p>
            </div>
        </div>
    </div>
</template>
<style scoped></style>

<script setup lang="ts">
import { UsuarioStore } from '~/stores/UsuarioStore';
const usuarioStore = UsuarioStore();
const userRole = usuarioStore.userRole;

const router = useRouter();
function pushPath(path: string) {
    return router.push(path)
}

</script>