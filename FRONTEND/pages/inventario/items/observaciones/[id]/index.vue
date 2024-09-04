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
  
    <div id="table" class="mx-2">
      <ClientOnly>
        <TableObservacion></TableObservacion>
      </ClientOnly>
    </div>
  </div>
</template>

<script lang="ts" setup>

</script>

<style></style>