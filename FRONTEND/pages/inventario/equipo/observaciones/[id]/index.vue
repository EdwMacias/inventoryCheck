<template>
  <div>
    <div class="breadcrumbs text-lg ">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink :to="INDEX_PAGE_INVENTARIO">Inventario</NuxtLink>
        </li>
        <li>
          Equipo
        </li>
        <li>
          Observación
        </li>
        
      </ul>
    </div>

    <h3 class="font-semibold text-lg ">Historial del Equipo</h3>
    <div class="bg-base-100 rounded-md p-4">

      <div class="flex justify-end">

        <div class="tooltip  tooltip-left" data-tip="Crear Observacion">
          <NuxtLink :to="`${INDEX_PAGE_INVENTARIO_OBSERVACION_EQUIPO}${route.params.id}/crear`" class="btn btn-neutral">
            <i class="bi bi-plus-circle"></i></NuxtLink>
        </div>

      </div>

      <ClientOnly>
        <TableObservacionEquipos></TableObservacionEquipos>
      </ClientOnly>

    </div>
  </div>
</template>

<script lang="ts" setup>
import { INDEX_PAGE_INVENTARIO, INDEX_PAGE_INVENTARIO_OBSERVACION_EQUIPO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();

definePageMeta({
  middleware: ['redirect-trailing-slash']
})

</script>

<style scoped lang='css'>
@import '@/assets/css/tooltip.css';
</style>