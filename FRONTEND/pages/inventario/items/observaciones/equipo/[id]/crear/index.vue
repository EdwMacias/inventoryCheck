<template>
  <div class="breadcrumbs text-lg mx-5 mt-20">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="`/inventario/items/observaciones/equipo/${route.params.id}`"> Observación Equipo
        </NuxtLink>
      </li>
      <li>
        Crear
      </li>
    </ul>
  </div>
  <div class="mt-2">
    <div class="container  mx-auto bg-base-100 p-5 rounded-lg">
      <FormularioFormObservacionEquipo @callback="crearObservacion"></FormularioFormObservacionEquipo>
    </div>
  </div>
</template>

<script lang="ts" setup>
import type { EquipoObservacionCreateDTO } from '~/Domain/DTOs/Observaciones/Equipos/EquipoObservacionCreateDTO';

const route = useRoute();

const crearObservacion = (equipoObservacionCreateDTO: EquipoObservacionCreateDTO) => {
  console.log(equipoObservacionCreateDTO);
}

</script>

<style></style>