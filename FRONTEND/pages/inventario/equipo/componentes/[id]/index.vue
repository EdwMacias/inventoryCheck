<template>
  <div>
    <div class="breadcrumbs text-lg  ">
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
          Componentes
        </li>
      </ul>
    </div>
    <div class="bg-base-100 rounded-md p-4">

      <div class="flex justify-end">

        <div class="tooltip  tooltip-left" data-tip="Registra Componente">
          <NuxtLink :to="`${INDEX_PAGE_COMPONENTES_EQUIPO}${route.params.id}/registrar`" class="btn btn-neutral">
            <i class="bi bi-plus-circle"></i>
          </NuxtLink>
        </div>

      </div>

      <ClientOnly>
          <TableComponentesEquipo></TableComponentesEquipo>
      </ClientOnly>

    </div>
  </div>
</template>

<script lang="ts" setup>
import { INDEX_PAGE_COMPONENTES_EQUIPO, INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();

</script>

<style></style>