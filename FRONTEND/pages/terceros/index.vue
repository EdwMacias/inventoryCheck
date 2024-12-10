<template>
  <!-- navegacion estatica-->
  <div class="">
    <div class="breadcrumbs text-lg">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <a>Terceros</a>
        </li>
      </ul>
    </div>


    <div class="container mx-auto mx-5 bg-base-100 rounded-lg">

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 p-4">
        <div>
          <NuxtLink :to="INDEX_PAGE_TERCERO_JURIDICO"
            class="card bg-base-100 image-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
            <figure class="h-64">
              <img src="/images/tercerosWorkSpace.webp" alt="Tercero Juridico" class="object-cover w-full h-full" />
            </figure>
            <div class="card-body">
              <h2 class="card-title">Tercero Jurídico</h2>
              <p>Consulta los terceros jurídicos registrados</p>
            </div>
          </NuxtLink>
        </div>
        <div>
          <NuxtLink :to="INDEX_PAGE_TERCERO_NATURAL"
            class="card bg-base-100 image-full shadow-xl cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
            <figure class="h-64">
              <img src="/images/tercerosWorkSpace.webp" alt="Tercero Natural" class="object-cover w-full h-full" />
            </figure>
            <div class="card-body">
              <h2 class="card-title">Tercero Natural</h2>
              <p>Consulta los terceros naturales registrados</p>
            </div>
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { INDEX_PAGE_TERCERO_JURIDICO, INDEX_PAGE_TERCERO_NATURAL, INDEX_PAGE_TERCERO_REGISTRAR } from '~/Infrastructure/Paths/Paths';



</script>

<style></style>