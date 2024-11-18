<template>
  <div>
    <div class="breadcrumbs text-lg mx-5 mt-20">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
        </li>
        <li>
          Observación Equipo
        </li>
      </ul>
    </div>

    <h3 class="font-semibold text-lg mx-5">Historial del Equipo</h3>
    <div class="container mt-10 mx-auto bg-base-100 rounded p-2">

      <div class="flex justify-end">
        
        <div class="tooltip  tooltip-left" data-tip="Crear Observacion">
          <NuxtLink to="crear" class="btn btn-neutral"><i class="bi bi-plus-circle"></i></NuxtLink>
</div>
       
      </div>

      <ClientOnly>

        <TableObservacionEquipos></TableObservacionEquipos>
      </ClientOnly>

    </div>
  </div>
</template>

<script lang="ts" setup>

definePageMeta({
  middleware: ['redirect-trailing-slash']
})

</script>

<style scoped lang='css'>
@import '@/assets/css/tooltip.css';
</style>