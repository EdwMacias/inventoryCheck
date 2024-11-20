<template>
    <div class="grid grid-cols-4 mx-auto container gap-10">

        <div class="card bg-base-100 image-full w-96 shadow-xl">
            <figure>
                <img src="https://cdn2.hubspot.net/hubfs/2283874/Fotos%20blog/inventario.jpg" alt="inventario" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Inventario!</h2>
                <p>Chequea todo lo relacionado con inventario</p>
                <div class="card-actions justify-end">
                    <NuxtLink to="/inventario/items/" class="btn btn-primary">Click Aqui</NuxtLink>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 image-full w-96 shadow-xl" v-if="userRole === 'SUPERADMINISTRADOR'">
            <figure>
                <img src="https://elmejorsoftwareerp.com/wp-content/uploads/2021/04/53571.jpg" alt="inventario" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Usuarios!</h2>
                <p>Gestiona y asigna roles a tus usuarios</p>
                <div class="card-actions justify-end">
                    <NuxtLink to="/usuarios/" class="btn btn-primary">Click Aqui</NuxtLink>
                </div>
            </div>
        </div>
        
        <div class="card bg-base-100 image-full w-96 shadow-xl">
            <figure>
                <img src="https://www.gerencie.com/wp-content/uploads/intervencion-terceros-procesos-administrativos.png" alt="inventario" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">TERCEROS!</h2>
                <p>Consulta de terceros</p>
                <div class="card-actions justify-end">
                    <NuxtLink to="/terceros/" class="btn btn-primary">Click Aqui</NuxtLink>
                </div>
            </div>
        </div>

        <!-- <NuxtLink to="/inventario/items/" class="kbd"><button>Inventario</button></NuxtLink>
        <NuxtLink to="/usuarios/" class="kbd"><button>Usuarios</button>
        </NuxtLink>
        <NuxtLink to="/terceros/" class="kbd"><button>Terceros</button></NuxtLink> -->
    </div>
</template>
<style scoped>
.en-proceso {
    height: 50%;
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.kbd {
    font-size: 3rem;
    padding: 1rem;
    border-radius: 1rem;
}
</style>

<script setup lang="ts">
function handleFiles(files: File[]) {
    console.log(files);
    // Aquí puedes manejar los archivos, subirlos al servidor, etc.
}

import { UsuarioStore } from '~/stores/UsuarioStore';
const usuarioStore = UsuarioStore();
const userRole = usuarioStore.userRole;
</script>