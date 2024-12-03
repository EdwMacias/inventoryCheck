<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/inventario/">Inventario</NuxtLink>
      </li>
      <li>
        Observaciones
      </li>
      <li>
        Oficina
      </li>
    </ul>
  </div>
  <!-- <div class="mx-5"> -->
  <!-- </div> -->
  <h3 class="font-semibold text-lg ">Historial de observacion Item Oficina</h3>

  <div class="bg-base-100 rounded-md p-5">
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