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
    <!-- <div class="mx-5"> -->
    <!-- </div> -->
    <h3 class="font-semibold text-lg  mx-5">Historial del Equipo</h3>
    <div class="container mt-10 mx-auto bg-base-100 rounded p-2">
      <ClientOnly>
        <TableObservacionEquipos></TableObservacionEquipos>
      </ClientOnly>
    </div>
  </div>
</template>

<script lang="ts" setup>

</script>

<style></style>