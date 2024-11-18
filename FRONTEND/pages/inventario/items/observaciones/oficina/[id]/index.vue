<template>
  <div class="breadcrumbs text-lg mx-5">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
      </li>
      <li>
        Observaciones Item Oficina
      </li>
    </ul>
  </div>
  <!-- <div class="mx-5"> -->
  <!-- </div> -->
  <h3 class="font-semibold text-lg  mx-5">Historial de observacion Item Oficina</h3>

  <div class="container mt-10 mx-auto bg-base-100 rounded p-2">
    <ClientOnly>
      
      <TableObservacionItemOficina></TableObservacionItemOficina>
    </ClientOnly>
  </div>

</template>

<script lang="ts" setup>


definePageMeta({
  middleware: ['redirect-trailing-slash']
})
// import ObservacionItemOficina from '~/components/Table/ObservacionItemOficina.vue';


</script>

<style></style>