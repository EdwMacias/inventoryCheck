<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="INDEX_PAGE_INVENTARIO">Inventario</NuxtLink>
      </li>
      <li>
        Oficina
      </li>
      <li>
        Observaciones
      </li>
    
    </ul>
  </div>

  <h3 class="font-semibold text-lg ">Historial de observacion Item Oficina</h3>

  <div class="bg-base-100 rounded-md p-5">
    <div class="flex justify-end">
      <div class="tooltip  tooltip-left" data-tip="Crear Observacion">
        <NuxtLink :to="`${INDEX_PAGE_INVENTARIO_OBSERVACION_OFICINA}${route.params.id}/crear`" class="btn btn-neutral">
          <i class="bi bi-plus-circle"></i>
        </NuxtLink>
      </div>
    </div>
    <ClientOnly>
      <TableObservacionItemOficina></TableObservacionItemOficina>
    </ClientOnly>
  </div>

</template>

<script lang="ts" setup>
import { INDEX_PAGE_INVENTARIO, INDEX_PAGE_INVENTARIO_OBSERVACION_OFICINA } from '~/Infrastructure/Paths/Paths';
const route = useRoute();


definePageMeta({
  middleware: ['redirect-trailing-slash']
})
// import ObservacionItemOficina from '~/components/Table/ObservacionItemOficina.vue';


</script>

<style></style>