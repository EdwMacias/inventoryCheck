<template>
    <div class="breadcrumbs text-lg mx-5">
        <ul>
            <li>
                <NuxtLink to="/">Inicio</NuxtLink>
            </li>
            <li>
                <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
            </li>
            <li>Crear Item</li>
        </ul>
    </div>
    <div class="mx-4">

        <h2 class="font-semibold text-xl mt-2">Creación de artículos</h2>

        <div>
            <label class="label">
                <span class="block text-md font-medium leading-6 ">Seleccione el registro a crear</span>
            </label>
            <select v-model="categoriaSeleccionada" class="select w-full max-w-xs text-base select-bordered">
                <option v-for="equipo in equipo" :key="equipo.id" :value="equipo.id">{{ equipo.opcion }}</option>
            </select>
        </div>
        <div v-if="categoriaSeleccionada == 0" class="mt-1 text-error animate__animated text-lg  animate__fadeIn">
            <p>
                Seleccione un tipo de equipo, por favor.
            </p>
        </div>

        <FormularioEquipos v-if="categoriaSeleccionada == 1" @callback="EquipoService.create" />
        <FormularioItem v-if="categoriaSeleccionada == 2" />

    </div>

</template>

<script setup lang="ts">
import { EquipoService } from '~/Domain/Client/Services/Items/equipo.service';

definePageMeta({
    middleware: ['actions-middleware']
})


const categoriaSeleccionada: Ref<number> = ref(1);
const equipo = ref([
    { id: 0, opcion: 'Seleccione' },
    { id: 1, opcion: 'Equipo de pista' },
    { id: 2, opcion: 'Administrativo' },
]);
</script>

<style scoped></style>