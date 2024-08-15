<template>
<div>
  <div class="breadcrumbs text-lg mx-5">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
      </li>
      <li>
        Observaciones
      </li>
    </ul>
  </div>
  <div id="Pagina" class="mx-2">
    <h3 class="font-semibold text-xl">Historial de calibracion, Verificaciones y mantenimiento de equipos</h3>   
  </div>
  <div id="table" class="mx-2">
    <ClientOnly>
    <TableObservacion :columns="columns"  ></TableObservacion>
    </ClientOnly>
    </div>
</div>
</template>

<script lang="ts" setup>
import type { ConfigColumns } from 'datatables.net-dt';

const columns: ConfigColumns[] = [
  { data: 'fecha', title: 'Fecha' },
  { data: 'asunto', title: 'Asunto' },
  { data: 'Descripction_Activity', title: 'Descripción de Actividad' },
  { data: 'state', title: 'Estado' },
  { data: 'signs', title: 'Firmado' },
  { data: 'next_activity', title: 'Proxima actividad' },
];
</script>

<style>

</style>